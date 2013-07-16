<?php
App::uses('AppController', 'Controller');
/**
 * CustomerGroups Controller
 *
 * @property CustomerGroup $CustomerGroup
 */
class CustomerGroupsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Customer Groups');
		$this->set('helplink','/pages/customerGroups#l');
		$this->set('add_menu',true);
		$this->CustomerGroup->recursive = 0;
		$this->set('customerGroups', $this->paginate());
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
		$this->set('formName','View Customer Group');
		$this->set('helplink','/pages/customerGroups#v');
		$this->CustomerGroup->id = $id;
		if (!$this->CustomerGroup->exists()) {
			throw new NotFoundException(__('Invalid customer group'));
		}
		$this->set('customerGroup', $this->CustomerGroup->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Customer Group');
		$this->set('helplink','/pages/customerGroups#a');
		$this->set('add_menu',true);
		if ($this->request->is('post')) {
			$this->CustomerGroup->create();
			$this->request->data['CustomerGroup']['created_id']=$this->Auth->user('id');
			if ($this->CustomerGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The customer group has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer group could not be saved. Please, try again.'));
			}
		}
		$items = $this->CustomerGroup->Item->find('list');
		$services = $this->CustomerGroup->Service->find('list');
		$this->set(compact('items', 'services'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Customer Group');
		$this->set('helplink','/pages/customerGroups#e');
		$this->CustomerGroup->id = $id;
		if (!$this->CustomerGroup->exists()) {
			throw new NotFoundException(__('Invalid customer group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CustomerGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The customer group has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->CustomerGroup->read(null, $id);
		}
		$items = $this->CustomerGroup->Item->find('list');
		$services = $this->CustomerGroup->Service->find('list');
		$this->set(compact('items', 'services'));
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
		$this->CustomerGroup->id = $id;
		if (!$this->CustomerGroup->exists()) {
			throw new NotFoundException(__('Invalid customer group'));
		}
		if ($this->CustomerGroup->delete()) {
			$this->Session->setFlash(__('Customer group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Customer group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
