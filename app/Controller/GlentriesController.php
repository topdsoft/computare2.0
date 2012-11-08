<?php
App::uses('AppController', 'Controller');
/**
 * Glentries Controller
 *
 * @property Glentry $Glentry
 */
class GlentriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Glentry->recursive = 0;
		$this->set('glentries', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Glentry->id = $id;
		if (!$this->Glentry->exists()) {
			throw new NotFoundException(__('Invalid glentry'));
		}
		$this->set('glentry', $this->Glentry->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Glentry->create();
			if ($this->Glentry->save($this->request->data)) {
				$this->Session->setFlash(__('The glentry has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The glentry could not be saved. Please, try again.'));
			}
		}
		$glaccounts = $this->Glentry->Glaccount->find('list');
		$glchecks = $this->Glentry->Glcheck->find('list');
		$this->set(compact('glaccounts', 'glchecks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Glentry->id = $id;
		if (!$this->Glentry->exists()) {
			throw new NotFoundException(__('Invalid glentry'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Glentry->save($this->request->data)) {
				$this->Session->setFlash(__('The glentry has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The glentry could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Glentry->read(null, $id);
		}
		$glaccounts = $this->Glentry->Glaccount->find('list');
		$glchecks = $this->Glentry->Glcheck->find('list');
		$this->set(compact('glaccounts', 'glchecks'));
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
		$this->Glentry->id = $id;
		if (!$this->Glentry->exists()) {
			throw new NotFoundException(__('Invalid glentry'));
		}
		if ($this->Glentry->delete()) {
			$this->Session->setFlash(__('Glentry deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Glentry was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
