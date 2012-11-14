<?php
App::uses('AppController', 'Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','View Forms');
		$this->Form->recursive = 0;
		$this->set('forms', $this->paginate());
		//get users list
		$this->set('usersList',$this->Form->User->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function view($id = null) {
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		$this->set('form', $this->Form->read(null, $id));
	}
 */

/**
 * add method
 *
 * @return void
	public function add() {
		if ($this->request->is('post')) {
			$this->Form->create();
			//created_id is current user id
			$this->request->data['Form']['created_id']=$this->Auth->user('id');
//debug($this->request->data);exit;
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		}
		$groups = $this->Form->Group->find('list');
		$menus = $this->Form->Menu->find('list');
		$users = $this->Form->User->find('list');
		$this->set(compact('groups', 'menus', 'users'));
	}
 */

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Form');
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Form->read(null, $id);
		}
		$groups = $this->Form->Group->find('list');
		$menus = $this->Form->Menu->find('list');
		$users = $this->Form->User->find('list');
		$this->set(compact('groups', 'menus', 'users'));
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
		$this->set('formName','Delete Form');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		if ($this->Form->delete()) {
			$this->Session->setFlash(__('Form deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Form was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
