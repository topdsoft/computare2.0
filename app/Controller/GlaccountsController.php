<?php
App::uses('AppController', 'Controller');
/**
 * Glaccounts Controller
 *
 * @property Glaccount $Glaccount
 */
class GlaccountsController extends AppController {

	public $components=array('ComputareGL');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List GL Accounts');
		$this->Glaccount->recursive = 0;
		$this->set('glaccounts', $this->paginate());
		//find lists
		$glgroups = $this->Glaccount->GlaccountDetail->Glgroup->find('list');
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('glgroups','users'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Glaccount->id = $id;
		if (!$this->Glaccount->exists()) {
			throw new NotFoundException(__('Invalid glaccount'));
		}
		$this->set('glaccount', $this->Glaccount->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//adding account uses the edit function with null id
		$this->set('formName','Add New GL Account');
		$this->redirect(array('action' => 'edit'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit GL Account');
		if($id) {
			//validate $id
			$this->Glaccount->id = $id;
			if (!$this->Glaccount->exists()) throw new NotFoundException(__('Invalid account'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//save account data
			$this->request->data['GlaccountDetail']['created_id']=$this->Auth->user('id');
//debug($this->request->data);exit;
			if ($this->ComputareGL->saveAccount($this->request->data)) {
				$this->Session->setFlash(__('The GL account has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The GL account could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Glaccount->read(null, $id);
		}
		//get list of GL account groups
		$glgroups = $this->Glaccount->GlaccountDetail->Glgroup->find('list');
		if(count($glgroups)<1) {
			//must have at least one gl account group set up
			$this->Session->setFlash(__('You must first set up at least one GL account group before you can add accounts.'));
			$this->redirect(array('controller'=>'glgroups','action' => 'index'));
		}//endif
		$this->set(compact('glgroups'));
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
		$this->Glaccount->id = $id;
		if (!$this->Glaccount->exists()) {
			throw new NotFoundException(__('Invalid glaccount'));
		}
		if ($this->Glaccount->delete()) {
			$this->Session->setFlash(__('Glaccount deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Glaccount was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
