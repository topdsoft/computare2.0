<?php
App::uses('AppController', 'Controller');
/**
 * InventoryLocks Controller
 *
 * @property InventoryLock $InventoryLock
 */
class InventoryLocksController extends AppController {

	public $components=array('ComputareIC');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','Inventory Locks');
		$this->set('menu_add',true);
		$this->InventoryLock->recursive = 0;
		$this->set('inventoryLocks', $this->paginate());
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
		$this->set('formName','View Inventory Lock');
		$this->InventoryLock->id = $id;
		if (!$this->InventoryLock->exists()) {
			throw new NotFoundException(__('Invalid inventory lock'));
		}
		$this->set('inventoryLock', $this->InventoryLock->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Inventory Lock');
		if ($this->request->is('post')) {
			$this->InventoryLock->create();
			//setup data
			if($this->request->data['InventoryLock']['notes']=='')unset($this->request->data['InventoryLock']['notes']);
			if ($this->ComputareIC->lockLocation($this->request->data['InventoryLock'])) {
				//saved ok
				$this->Session->setFlash(__('The inventory lock has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				//not saved
				$this->Session->setFlash(__('The inventory lock could not be saved. Please, try again.'));
			}
		}
		$locations = $this->InventoryLock->Location->generateTreeList(null,null,null,'-');
		$this->set(compact('locations'));
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
		$this->InventoryLock->id = $id;
		if (!$this->InventoryLock->exists()) {
			throw new NotFoundException(__('Invalid inventory lock'));
		}
		if ($this->InventoryLock->delete()) {
			$this->Session->setFlash(__('Inventory lock deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inventory lock was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
