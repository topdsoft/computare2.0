<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 */
class LocationsController extends AppController {

	public $components=array('ComputareIC');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Locations');
		$this->Location->recursive = 0;
		$this->set('locations', $this->paginate());
		$this->set('locationsList',$this->Location->generateTreeList(null,null,null,' - '));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','Location Details');
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}

/**
 * add method
 *
 * @param int $defaultParent
 * @return void
 */
	public function add($defaultParent=0) {
		$this->set('formName','New Location');
		if ($this->request->is('post')) {
			$this->Location->create();
			if ($this->ComputareIC->saveLocation($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else $this->request->data['Location']['parent_id']=$defaultParent;
// 		$locationDetails = $this->Location->LocationDetail->find('list');
		$parents = $this->Location->ParentLocation->find('list');
// debug($parents);exit;
		$parents[0]='(none)';
// 		$items = $this->Location->Item->find('list');
		$this->set(compact('parents'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Location');
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareIC->saveLocation($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Location->read(null, $id);
		}
// 		$locationDetails = $this->Location->LocationDetail->find('list');
// 		$parentLocations = $this->Location->ParentLocation->find('list');
// 		$items = $this->Location->Item->find('list');
		$parents = $this->Location->ParentLocation->find('list');
		$parents[0]='(none)';
		$this->set(compact('parents'));
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
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->Location->delete()) {
			$this->Session->setFlash(__('Location deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
