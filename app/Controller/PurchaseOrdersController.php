<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseOrders Controller
 *
 * @property PurchaseOrder $PurchaseOrder
 */
class PurchaseOrdersController extends AppController {

	public $components=array('ComputareAR');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Purchase orders');
		$this->PurchaseOrder->recursive = 0;
		$this->set('purchaseOrders', $this->paginate());
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
		$this->set('formName','View Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		$this->set('purchaseOrder', $this->PurchaseOrder->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Purchase Order');
		if ($this->request->is('post')) {
			$this->request->data['PurchaseOrder']['status']='O';
// debug($this->request->data);exit;
			if ($this->ComputareAR->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$this->PurchaseOrder->getInsertId()));
			} else {
				$this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'));
			}
		}
		$vendors = $this->PurchaseOrder->Vendor->find('list');
		$this->set(compact('vendors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PurchaseOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PurchaseOrder->read(null, $id);
		}
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if ($this->PurchaseOrder->delete()) {
			$this->Session->setFlash(__('Purchase order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Purchase order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
