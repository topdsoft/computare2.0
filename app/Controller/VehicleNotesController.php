<?php
App::uses('AppController', 'Controller');
/**
 * VehicleNotes Controller
 *
 * @property VehicleNote $VehicleNote
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class VehicleNotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->VehicleNote->recursive = 0;
		$this->set('vehicleNotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VehicleNote->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle note'));
		}
		$options = array('conditions' => array('VehicleNote.' . $this->VehicleNote->primaryKey => $id));
		$this->set('vehicleNote', $this->VehicleNote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->VehicleNote->create();
			if ($this->VehicleNote->save($this->request->data)) {
				$this->Flash->success(__('The vehicle note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vehicle note could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->VehicleNote->Vehicle->find('list');
		$this->set(compact('vehicles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->VehicleNote->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->VehicleNote->save($this->request->data)) {
				$this->Flash->success(__('The vehicle note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vehicle note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VehicleNote.' . $this->VehicleNote->primaryKey => $id));
			$this->request->data = $this->VehicleNote->find('first', $options);
		}
		$vehicles = $this->VehicleNote->Vehicle->find('list');
		$this->set(compact('vehicles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->VehicleNote->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle note'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->VehicleNote->delete($id)) {
			$this->Flash->success(__('The vehicle note has been deleted.'));
		} else {
			$this->Flash->error(__('The vehicle note could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
