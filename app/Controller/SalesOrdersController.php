<?php
App::uses('AppController', 'Controller');
/**
 * SalesOrders Controller
 *
 * @property SalesOrder $SalesOrder
 */
class SalesOrdersController extends AppController {

	public $components=array('ComputareCustomer','ComputareAR');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Sales Orders');
		$this->SalesOrder->recursive = 0;
		$this->set('salesOrders', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Sales Order');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$this->set('salesOrder', $this->SalesOrder->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Sales Order');
		if ($this->request->is('post')) {
			$this->SalesOrder->create();
			$this->request->data['SalesOrder']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrder']['status']='O';
			if ($this->ComputareAR->saveSO($this->request->data)) {
				$this->Session->setFlash(__('The sales order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales order could not be saved. Please, try again.'));
			}
		}
		$salesOrderTypes = $this->SalesOrder->SalesOrderType->find('list',array('conditions'=>array('active')));
		if(!$salesOrderTypes) {
			//must first have SO types
			$this->Session->setFlash(__('You must define at least one Sales Order Type before creating Sales Orders.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		$customers = $this->SalesOrder->Customer->find('list',array('conditions'=>array('active')));
		if(!$customers) {
			//must first have customers
			$this->Session->setFlash(__('You must define at least one Customer before creating Sales Orders.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		$this->set(compact('salesOrderTypes', 'customers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Sales Order');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$SO=$this->SalesOrder->read(null, $id);
		if($SO['SalesOrder']['status']!='O') {
			//only open SO can be edited
			$this->Session->setFlash(__('Only Sales Orders with status of Open can be edited.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->redirect(array('action' => 'index'));
		} else {
			$this->request->data = $SO;
		}
// 		$salesOrderTypes = $this->SalesOrder->SalesOrderType->find('list');
// 		$customers = $this->SalesOrder->Customer->find('list');
		$items=ClassRegistry::init('Item')->find('list');
		$services=ClassRegistry::init('Service')->find('list');
		$servicesPricing=ClassRegistry::init('Service')->find('list',array('fields'=>array('id','pricing')));
		$this->set(compact('items','services','servicesPricing'));
	}

/**
 * addproduct method
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function addproduct($id = null) {
		$this->set('formName','Add Product SO Line');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$SO=$this->SalesOrder->read(null, $id);
		if($SO['SalesOrder']['status']!='O') {
			//only open SO can be edited
			$this->Session->setFlash(__('Only Sales Orders with status of Open can be edited.'));
			$this->redirect(array('action' => 'index'));
		}//endif
// 		$this->SalesOrder->ItemDetail->validator()->add('price','required',array('rule'=>array('comparison','>',0),'message'=>'Please enter a unit price'));
// 		$this->SalesOrder->ItemDetail->validator()->add('qty','required',array('rule'=>array('comparison','>',0),'message'=>'Must be greater than 0'));
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SalesOrderDetail']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrderDetail']['active']=true;
			$this->request->data['SalesOrderDetail']['salesOrder_id']=$id;
			if($this->request->data['SalesOrderDetail']['price']==''){
				//get customer price
				if($this->request->data['SalesOrderDetail']['qty']=='') $tmpQty=1;
				else $tmpQty=$this->request->data['SalesOrderDetail']['qty'];
				$this->request->data['SalesOrderDetail']['price']=$this->ComputareAR->getPrice($SO['Customer']['id'],$this->request->data['SalesOrderDetail']['item_id'],$tmpQty);
				unset($tmpQty);
			}//endif
// debug($this->request->data);exit;
			if(!$this->request->data['SalesOrderDetail']['price']) {
				//price lookup failed
// 				$this->Session->setFlash(__('No price is set for this item.  You must enter price.'));
				$this->set('priceRequired',true);
			}//endif
//			if ($this->SalesOrder->ItemDetail->save($this->request->data['ItemDetail'])) {
			if ($this->ComputareAR->saveLine(array('SalesOrderDetail'=>$this->request->data['SalesOrderDetail']))) {
				$this->Session->setFlash(__('An Item has been added to your Sales order'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The Item could not be added. Please, try again.'));
				$this->request->data['Customer']=$SO['Customer'];
				$this->request->data['SalesOrderType']=$SO['SalesOrderType'];
				$this->request->data['SalesOrder']=$SO['SalesOrder'];
			}//endif
		} else {
			$this->request->data = $SO;
		}
		$items=ClassRegistry::init('Item')->find('list');
		$this->set(compact('items'));
	}

/**
 * addservice method
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function addservice($id = null) {
		$this->set('formName','Add Service SO Line');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$SO=$this->SalesOrder->read(null, $id);
		if($SO['SalesOrder']['status']!='O') {
			//only open SO can be edited
			$this->Session->setFlash(__('Only Sales Orders with status of Open can be edited.'));
			$this->redirect(array('action' => 'index'));
		}//endif
// 		$this->SalesOrder->ServiceDetail->validator()->add('qty','required',array('rule'=>array('comparison','>',0),'message'=>'Must be greater than 0'));
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SalesOrderDetail']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrderDetail']['active']=true;
			$this->request->data['SalesOrderDetail']['salesOrder_id']=$id;
// debug($this->request->data);exit;
			if(isset($this->request->data['SalesOrderDetail']['qty'])) {
				//done selecting qty
				if ($this->ComputareAR->saveLine(array('SalesOrderDetail'=>$this->request->data['SalesOrderDetail']))) {
					$this->Session->setFlash(__('A Service has been added to your Sales order'),'default',array('class'=>'success'));
					$this->redirect(array('action' => 'edit',$id));
				} else {
					$this->Session->setFlash(__('The Service could not be added. Please, try again.'));
					$service=ClassRegistry::init('Service')->find('first',array('conditions'=>array('id'=>$this->request->data['SalesOrderDetail']['service_id'])));
					$this->set('service',$service);
				}
			} else {
				//selected service now pick qty
				$service=ClassRegistry::init('Service')->find('first',array('conditions'=>array('id'=>$this->request->data['SalesOrderDetail']['service_id'])));
				$this->set('service',$service);
				if(!isset($this->request->data['SalesOrderDetail']['price']))$this->request->data['SalesOrderDetail']['price']=$service['Service']['rate'];
			}//end if
			$this->request->data['SalesOrder']['id']=$SO['SalesOrder']['id'];
			$this->request->data['Customer']=$SO['Customer'];
			$this->request->data['SalesOrderType']=$SO['SalesOrderType'];
		} else {
			$this->request->data = $SO;
		}
		$services=ClassRegistry::init('Service')->find('list',array('conditions'=>array('active')));
		$this->set(compact('services'));
	}

/**removeLine method
 * 
 * @param string $id
 * @returns to SO edit
 */
	public function removeLine($id=null) {
		$this->set('formName','Remove SO Line');
		//validate
		$this->SalesOrderDetail=ClassRegistry::init('SalesOrderDetail');
		$this->SalesOrderDetail->id=$id;
		if (!$this->SalesOrderDetail->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$detail=$this->SalesOrderDetail->read();
		if($detail['SalesOrder']['status']!='O') {
			$this->Session->setFlash(__('This sales order is not open so can not be edited.'));
			$this->redirect(array('action'=>'index'));
		}//endif
// debug($detail);exit;
		if($this->ComputareAR->removeLine($id)) {
			//ok
			$this->Session->setFlash(__('Line Removed from Sales Order.'));
			$this->redirect(array('action'=>'edit',$detail['SalesOrder']['id']));
		} else {
			//fail
			$this->Session->setFlash(__('SO Line could not be removed.'));
			$this->redirect(array('action'=>'edit',$detail['SalesOrder']['id']));
		}
	}


/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function delete($id = null) {
		$this->set('formName','name');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		if ($this->SalesOrder->delete()) {
			$this->Session->setFlash(__('Sales order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sales order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
 */
}
