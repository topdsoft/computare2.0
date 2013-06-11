<?php
App::uses('AppController', 'Controller');
/**
 * TimeRecords Controller
 *
 * @property TimeRecord $TimeRecord
 */
class TimeRecordsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TimeRecord->recursive = 0;
		$this->set('timeRecords', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TimeRecord->id = $id;
		if (!$this->TimeRecord->exists()) {
			throw new NotFoundException(__('Invalid time record'));
		}
		$this->set('timeRecord', $this->TimeRecord->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TimeRecord->create();
			if ($this->TimeRecord->save($this->request->data)) {
				$this->Session->setFlash(__('The time record has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time record could not be saved. Please, try again.'));
			}
		}
		$users = $this->TimeRecord->User->find('list');
		$tasks = $this->TimeRecord->Task->find('list');
		$this->set(compact('users', 'tasks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->TimeRecord->id = $id;
		if (!$this->TimeRecord->exists()) {
			throw new NotFoundException(__('Invalid time record'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TimeRecord->save($this->request->data)) {
				$this->Session->setFlash(__('The time record has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time record could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TimeRecord->read(null, $id);
		}
		$users = $this->TimeRecord->User->find('list');
		$tasks = $this->TimeRecord->Task->find('list');
		$this->set(compact('users', 'tasks'));
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
		$this->TimeRecord->id = $id;
		if (!$this->TimeRecord->exists()) {
			throw new NotFoundException(__('Invalid time record'));
		}
		if ($this->TimeRecord->delete()) {
			$this->Session->setFlash(__('Time record deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Time record was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
