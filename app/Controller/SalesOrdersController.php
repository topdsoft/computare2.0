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
		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',true);
		//setup filters
		$filters=array();
		//id filter
		$filters[]=array(
			'type'=>2,
			'label'=>'SO#',
			'passName'=>'soid',
			'field'=>'SalesOrder.id',
		);
		//customer filter
		$filters[]=array(
			'type'=>1,
			'label'=>'Customer',
			'passName'=>'cst',
			'field'=>'SalesOrder.customer_id',
			'options'=>$this->SalesOrder->Customer->find('list',array('conditions'=>array('active')))
		);
		//status filter
		$filters[]=array(
			'type'=>1,
			'label'=>'Status',
			'passName'=>'status',
			'field'=>'SalesOrder.status',
			'options'=>array('O'=>'Open','V'=>'Void','C'=>'Closed'),
		);
		//type filter
		$filters[]=array(
			'type'=>1,
			'label'=>'Type',
			'passName'=>'type',
			'field'=>'SalesOrder.salesOrderType_id',
			'options'=>$this->SalesOrder->SalesOrderType->find('list',array('conditions'=>array('active')))
		);
		//created filter
		$filters[]=array('type'=>3,
			'label'=>'Date',
			'passName'=>'created',
			'field'=>'SalesOrder.created');
		//Created by filter
		$filters[]=array(
			'type'=>1,
			'label'=>'User',
			'passName'=>'user',
			'field'=>'SalesOrder.created_id',
			'options'=>ClassRegistry::init('User')->find('list')
		);
		//submit filters
		$this->_useFilter($filters);
		$this->SalesOrder->recursive = 0;
		$this->set('salesOrders', $this->paginate('SalesOrder',$this->conditions));
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
		$this->set('helplink','/pages/salesOrders#v');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$this->SalesOrder->recursive=2;
		$this->set('salesOrder', $this->SalesOrder->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Sales Order');
		$this->set('helplink','/pages/salesOrders#a');
		if ($this->request->is('post')) {
			//saving
			$this->SalesOrder->create();
			$this->request->data['SalesOrder']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrder']['status']='O';
			if ($this->ComputareAR->saveSO($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The sales order has been started'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'edit',$this->SalesOrder->getInsertId()));
			} else {
				//validation failed
				$this->Session->setFlash(__('The sales order could not be saved. Please, try again.'));
			}
		} else {
			//check for defaults
			$this->request->data['SalesOrder']=$this->passedArgs;
// 			if(isset($this->passedArgs['customer_id'])) $this->request->data['SalesOrder']['customer_id']=$this->passedArgs['customer_id'];
		}//endif
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
		$this->set('helplink','/pages/salesOrders#e');
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
			if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
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
		$this->set('helplink','/pages/salesOrders#e');
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
		}//endif
		//get list of items
		$this->Item=ClassRegistry::init('Item');
		if($SO['SalesOrderType']['stock_required']) {
			//only show items that have stock
			$this->Location=ClassRegistry::init('Location');
			//get list of locations that item can come from
			$rght=$this->Location->field('rght',array('Location.id'=>$SO['SalesOrderType']['location_id']));
			$lft=$this->Location->field('lft',array('Location.id'=>$SO['SalesOrderType']['location_id']));
			$locationsList=$this->Location->find('list',array('fields'=>'Location.id','conditions'=>array('Location.lft <='=>$rght,'Location.lft >='=>$lft)));
			unset($rght);
			unset($lft);
			//find all items at these locations
			$itemsList=$this->Item->ItemsLocation->find('list',array('fields'=>'item_id','conditions'=>array('location_id'=>$locationsList)));
			$items=$this->Item->find('list',array('conditions'=>array('Item.id'=>$itemsList)));
			unset($itemsList);
			unset($locationsList);
// debug($itemsList);
		} else {
			//can include any active item
			$items=$this->Item->find('list',array('conditions'=>array('Item.active')));
		}//endif
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
		$this->set('helplink','/pages/salesOrders#e');
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

/**
 * addservicepm method
 * Adds service hours from project managment for this customer
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function addservicepm($id = null) {
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
// debug($SO);
		//get projects for selected customer
		$this->loadModel('Project');
		$projects=$this->Project->find('all',array('recursive'=>1,'conditions'=>array('customer_id'=>$SO['Customer']['id'])));
		$tasks=array();
		foreach($projects as $p) {
			//loop for all projects
			foreach($p['Task'] as $t) {
				//loop for all tasks
				$tasks[]=$t['id'];
			}//end foreach $tasks
		}//end foreach $projects
		unset($projects);
		$this->loadModel('TimeRecord');
		$timeRecords=$this->TimeRecord->find('all',array('recursive'=>1,'conditions'=>array(
			'TimeRecord.task_id'=>$tasks,
			'TimeRecord.SalesOrderDetail_id'=>null)));
		unset($tasks);
		if ($this->request->is('post') || $this->request->is('put')) {
			//change later
			foreach($timeRecords as $timeRecord) {
				//loop for all time records and add them to the SO
				debug($timeRecord);
				$this->request->data['SalesOrderDetail']['created_id']=$this->Auth->user('id');
				$this->request->data['SalesOrderDetail']['active']=true;
				$this->request->data['SalesOrderDetail']['salesOrder_id']=$id;
				$this->request->data['SalesOrderDetail']['qty']=$timeRecord['TimeRecord']['duration'];
				$this->request->data['SalesOrderDetail']['timeRecord_id']=$timeRecord['TimeRecord']['id'];
				$service=ClassRegistry::init('Service')->find('first',array('conditions'=>array('id'=>$this->request->data['SalesOrderDetail']['service_id'])));
				$this->request->data['SalesOrderDetail']['price']=$service['Service']['rate'];
debug($this->request->data);exit;
				
			}//end foreach
		} else {
			$this->request->data = $SO;
		}//endif
// debug($tasks);
// debug($timeRecords);
		$projects=ClassRegistry::init('Project')->find('list');
		$services=ClassRegistry::init('Service')->find('list',array('conditions'=>array('active')));
		$this->set(compact('timeRecords','projects','services'));
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
 * complete method
 * @param $id
 * 
 * used to close SO and invoice customer
 */
	public function complete($id=null) {
		$this->set('formName','Complete Sale');
		$this->set('helplink','/pages/salesOrders#c');
		$this->SalesOrder->id = $id;
		if (!$this->SalesOrder->exists()) {
			throw new NotFoundException(__('Invalid sales order'));
		}
		$SO=$this->SalesOrder->read(null, $id);
		if($SO['SalesOrder']['status']!='O') {
			//only open SO can be completed
			$this->Session->setFlash(__('Only Sales Orders with status of Open can be Completed.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//process return from form
			if($this->request->data['SalesOrderType']['on_account']) {
				//process sale on account
			} else {
				//process cash sale
				if(isset($this->request->data['SalesOrder']['done'])) {
					//finish transaction
					if($this->ComputareAR->completeSale($this->request->data)) {
						//SO closed ok
						$this->Session->setFlash(__("Sales Order Closed"),'default',array('class'=>'success'));
						if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
						$this->redirect(array('action' => 'index'));
					} else {
						//failed to close SO
						$this->Session->setFlash(__("Sales Order Could Not be Closed"));
						$this->redirect(array('action' => 'index'));
					}//endif
// debug($this->request->data);exit;
				} else {
					//get fee or identification data
					$SO['SalesOrder']['paymentType_id']=$this->request->data['SalesOrder']['paymentType_id'];
					if(isset($this->request->data['SalesOrder']['shipping']))$SO['SalesOrder']['shipping']=$this->request->data['SalesOrder']['shipping'];
					$this->request->data = $SO;
					//get parameters for payment type
					$this->set('paymentType',ClassRegistry::init('PaymentType')->read(null,$SO['SalesOrder']['paymentType_id']));
					//get parameters for soType
					$this->set('soType',$this->SalesOrder->SalesOrderType->read(null,$SO['SalesOrder']['salesOrderType_id']));
				}//endif
			}//endif
		} else {
			$this->request->data = $SO;
		}
		$items=ClassRegistry::init('Item')->find('list');
		$services=ClassRegistry::init('Service')->find('list');
		$servicesPricing=ClassRegistry::init('Service')->find('list',array('fields'=>array('id','pricing')));
		$paymentTypes=ClassRegistry::init('PaymentType')->find('list');
		$this->set(compact('items','services','servicesPricing','paymentTypes'));
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
