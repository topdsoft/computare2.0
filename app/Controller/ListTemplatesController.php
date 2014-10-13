<?php
App::uses('AppController', 'Controller');
/**
 * ListTemplates Controller
 *
 * @property ListTemplate $ListTemplate
 */
class ListTemplatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ListTemplate->recursive = 0;
		$this->set('listTemplates', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ListTemplate->id = $id;
		if (!$this->ListTemplate->exists()) {
			throw new NotFoundException(__('Invalid list template'));
		}
		$this->set('listTemplate', $this->ListTemplate->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ListTemplate->create();
			if ($this->ListTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The list template has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The list template could not be saved. Please, try again.'));
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
		$this->ListTemplate->id = $id;
		if (!$this->ListTemplate->exists()) {
			throw new NotFoundException(__('Invalid list template'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ListTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The list template has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The list template could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ListTemplate->read(null, $id);
		}
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
		$this->ListTemplate->id = $id;
		if (!$this->ListTemplate->exists()) {
			throw new NotFoundException(__('Invalid list template'));
		}
		if ($this->ListTemplate->delete()) {
			$this->Session->setFlash(__('List template deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('List template was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
