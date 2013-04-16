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
		$this->set(compact('items','services'));
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
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SalesOrderDetail']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrderDetail']['active']=true;
			$this->request->data['SalesOrderDetail']['salesOrder_id']=$id;
// debug($this->request->data);exit;
			if ($this->SalesOrder->ItemDetail->save($this->request->data['SalesOrderDetail'])) {
				$this->Session->setFlash(__('An Item has been added to your Sales order'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The Item could not be added. Please, try again.'));
			}
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
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['SalesOrderDetail']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrderDetail']['active']=true;
			$this->request->data['SalesOrderDetail']['salesOrder_id']=$id;
// debug($this->request->data);exit;
			if ($this->ComputareAR->saveLine($this->request->data)) {
				$this->Session->setFlash(__('A Service has been added to your Sales order'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The Service could not be added. Please, try again.'));
			}
		} else {
			$this->request->data = $SO;
		}
		$services=ClassRegistry::init('Service')->find('list',array('conditions'=>array('active')));
		$this->set(compact('services'));
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
