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
		$this->set('inventoryLocks', $this->paginate('InventoryLock',array('InventoryLock.active')));
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
		//get lock data
		$lock=$this->InventoryLock->read(null, $id);
		$this->set('inventoryLock', $lock);
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('canUnlock', ($this->Auth->user('id')==1 || $lock['InventoryLock']['created_id']==$this->Auth->user('id')));
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
			if($this->request->data['InventoryLock']['notes']=='') unset($this->request->data['InventoryLock']['notes']);
			if ($this->ComputareIC->lockLocation($this->request->data['InventoryLock'])) {
				//saved ok
				$this->Session->setFlash(__('The inventory lock has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//not saved
				$this->Session->setFlash(__('The inventory lock could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data['InventoryLock']=$this->passedArgs;
		}//endif
		$locations = $this->InventoryLock->Location->generateTreeList(null,null,null,'-');
		$this->set(compact('locations'));
	}

/**
 * release method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function release($id = null) {
		$this->InventoryLock->id = $id;
		if (!$this->InventoryLock->exists()) {
			throw new NotFoundException(__('Invalid inventory lock'));
		}
		if ($this->ComputareIC->unlockLocation(array('inventoryLock_id'=>$id))) {
			$this->Session->setFlash(__('Inventory lock released'));
			if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inventory lock was not released'));
		if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
		$this->redirect(array('action' => 'index'));
	}
}
