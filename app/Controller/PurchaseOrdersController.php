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
		$this->PurchaseOrder->bindModel(
			array('hasMany' => array(
				'RemovedLine' => array(
					'className'=>'PurchaseOrderDetail',
					'conditions'=>array('RemovedLine.active'=>false)
					),
				)
			)
		);
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
 * addline method
 *
 * @param int $id  (po id)
 * @return void
 */
	public function addline($id=null) {
		$this->set('formName','Edit Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			if ($this->ComputareAR->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PurchaseOrder->read(null, $id);
		}
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/** removeline method
 * @param int $id (purchseOederDetails.id for line to remove)
 */
	public function removeline($id) {
		$this->set('formName','Edit Purchase Order');
		$podetail=$this->PurchaseOrder->PurchaseOrderDetail->read(null, $id);
		if (!$podetail) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if($this->ComputareAR->savePO(array('removeLine'=>$id))) $this->Session->setFlash(__('The line has been removed'),'default',array('class'=>'success'));
		else $this->Session->setFlash(__('The line could not be removed'));
		$this->redirect(array('action' => 'edit',$podetail['PurchaseOrderDetail']['purchaseOrder_id']));
	}

/** void method
 * @param int $id
 */
	public function void($id) {
		$this->set('formName','Void Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		$data['PurchaseOrder']['id']=$id;
		$data['PurchaseOrder']['status']='V';
		if($this->ComputareAR->savePO($data)) $this->Session->setFlash(__('The PO has been voided'),'default',array('class'=>'success'));
		else $this->Session->setFlash(__('The PO could not be voided'));
		$this->redirect(array('action' => 'index'));
	}

/** close method
 * @param int $id
 */
	public function close($id) {
		$this->set('formName','Close Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		$this->request->data['PurchaseOrder']['id']=$id;
		$this->request->data['PurchaseOrder']['status']='C';
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareAR->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been closed'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order could not be closed. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PurchaseOrder->read(null, $id);
		}
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
// 		if($this->ComputareAR->savePO($data)) $this->Session->setFlash(__('The PO has been closed'),'default',array('class'=>'success'));
// 		else $this->Session->setFlash(__('The PO could not be closed'));
// 		$this->redirect(array('action' => 'index'));
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
			if ($this->ComputareAR->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'),'default',array('class'=>'success'));
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
