<?php
App::uses('AppController', 'Controller');
/**
 * SalesOrders Controller
 *
 * @property SalesOrder $SalesOrder
 */
class SalesOrdersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Sales Orders');
		$this->SalesOrder->recursive = 0;
		$this->set('salesOrders', $this->paginate());
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
			if ($this->SalesOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The sales order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales order could not be saved. Please, try again.'));
			}
		}
		$salesOrderTypes = $this->SalesOrder->SalesOrderType->find('list');
		if(!$salesOrderTypes) {
			//must first have SO types
			$this->Session->setFlash(__('You must define at least one Sales Order Type before creating Sales Orders.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		$customers = $this->SalesOrder->Customer->find('list');
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
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SalesOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The sales order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SalesOrder->read(null, $id);
		}
		$salesOrderTypes = $this->SalesOrder->SalesOrderType->find('list');
		$customers = $this->SalesOrder->Customer->find('list');
		$this->set(compact('salesOrderTypes', 'customers'));
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
