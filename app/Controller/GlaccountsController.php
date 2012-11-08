<?php
App::uses('AppController', 'Controller');
/**
 * Glaccounts Controller
 *
 * @property Glaccount $Glaccount
 */
class GlaccountsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Glaccount->recursive = 0;
		$this->set('glaccounts', $this->paginate());
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
		if ($this->request->is('post')) {
			$this->Glaccount->create();
			if ($this->Glaccount->save($this->request->data)) {
				$this->Session->setFlash(__('The glaccount has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The glaccount could not be saved. Please, try again.'));
			}
		}
		$glaccountdetails = $this->Glaccount->Glaccountdetail->find('list');
		$this->set(compact('glaccountdetails'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Glaccount->id = $id;
		if (!$this->Glaccount->exists()) {
			throw new NotFoundException(__('Invalid glaccount'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Glaccount->save($this->request->data)) {
				$this->Session->setFlash(__('The glaccount has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The glaccount could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Glaccount->read(null, $id);
		}
		$glaccountdetails = $this->Glaccount->Glaccountdetail->find('list');
		$this->set(compact('glaccountdetails'));
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
