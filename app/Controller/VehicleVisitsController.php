<?php
App::uses('AppController', 'Controller');
/**
 * VehicleVisits Controller
 *
 * @property VehicleVisit $VehicleVisit
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class VehicleVisitsController extends AppController {

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
		$this->VehicleVisit->recursive = 0;
		$this->set('vehicleVisits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VehicleVisit->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle visit'));
		}
		$options = array('conditions' => array('VehicleVisit.' . $this->VehicleVisit->primaryKey => $id));
		$this->set('vehicleVisit', $this->VehicleVisit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->VehicleVisit->create();
			if ($this->VehicleVisit->save($this->request->data)) {
				$this->Flash->success(__('The vehicle visit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vehicle visit could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->VehicleVisit->Vehicle->find('list');
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
		if (!$this->VehicleVisit->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle visit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->VehicleVisit->save($this->request->data)) {
				$this->Flash->success(__('The vehicle visit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vehicle visit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VehicleVisit.' . $this->VehicleVisit->primaryKey => $id));
			$this->request->data = $this->VehicleVisit->find('first', $options);
		}
		$vehicles = $this->VehicleVisit->Vehicle->find('list');
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
		if (!$this->VehicleVisit->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle visit'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->VehicleVisit->delete($id)) {
			$this->Flash->success(__('The vehicle visit has been deleted.'));
		} else {
			$this->Flash->error(__('The vehicle visit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
