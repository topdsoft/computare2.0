<?php
App::uses('AppController', 'Controller');
/**
 * FormGroups Controller
 *
 * @property FormGroup $FormGroup
 */
class FormGroupsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Form Groups');
		$this->set('add_menu',true);
		$this->set('helplink','/pages/formGroups#l');
		$this->FormGroup->recursive = 0;
		$this->set('formGroups', $this->paginate());
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
		$this->set('formName','View Form Group');
		$this->FormGroup->id = $id;
		if (!$this->FormGroup->exists()) {
			throw new NotFoundException(__('Invalid form group'));
		}
		$this->set('formGroup', $this->FormGroup->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Form Group');
		$this->set('helplink','/pages/formGroups#e');
		if ($this->request->is('post')) {
			$this->FormGroup->create();
			$this->request->data['FormGroup']['created_id']=$this->Auth->user('id');
// debug($this->request->data);exit;
			if ($this->FormGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The form group has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form group could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Form Group');
		$this->FormGroup->id = $id;
		if (!$this->FormGroup->exists()) {
			throw new NotFoundException(__('Invalid form group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FormGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The form group has been saved'));
				if(isset($this->request->params['named']['redirect'])) $this->redirect($this->request->params['named']['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->FormGroup->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->FormGroup->id = $id;
		if (!$this->FormGroup->exists()) {
			throw new NotFoundException(__('Invalid form group'));
		}
		if ($this->FormGroup->delete()) {
			$this->Session->setFlash(__('Form group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Form group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
 */
}
