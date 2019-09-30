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
/*	public function view($id = null) {
		if (!$this->VehicleVisit->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle visit'));
		}
		$options = array('conditions' => array('VehicleVisit.' . $this->VehicleVisit->primaryKey => $id));
		$this->set('vehicleVisit', $this->VehicleVisit->find('first', $options));
	}//*/

/**
 * add method
 * 
 * check in vehicle
 *
 * @return void
 * @param string $vehicle_id  valid vehicle to add in
 */
	public function add($vehicle_id = null) {
		$this->set('formName','Check In Vehicle');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',false);
		//check for valid vehicle id
		if (!$this->VehicleVisit->Vehicle->exists($vehicle_id)) {
			throw new NotFoundException(__('Invalid vehicle'));
		}//endif valid vehicle
		//check if vehicle is already in the shop
		if(false) {
			//vehilce is already in shop
			throw new NotFoundException(__('Vehicle all ready in shop'));
		}//endif allready in shop
		if ($this->request->is('post')) {
			$this->VehicleVisit->create();
			$this->request->data['VehicleVisit']['created_id']=$this->Auth->user('id');
			$this->request->data['VehicleVisit']['vehicle_id']=$vehicle_id;
//debug($this->request->data);exit;
			if ($this->VehicleVisit->save($this->request->data)) {
				$this->Flash->success(__('The vehicle has been checked in.'),'default',array('class'=>'success'));
				return $this->redirect(array('controller' => 'vehicles','action' => 'view', $vehicle_id));
			} else {
				$this->Flash->error(__('The vehicle visit could not be saved. Please, try again.'));
			}
		}
		$vehicles = $this->VehicleVisit->Vehicle->find('list');
		$this->set(compact('vehicles'));
		$this->set('vehicle_id',$vehicle_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Check Out Vehicle');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',false);
		if (!$this->VehicleVisit->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle visit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['VehicleVisit']['exit_id']=$this->Auth->user('id');
			$this->request->data['VehicleVisit']['exits']=date('Y-m-d H:i:s');
//debug($this->request->data);exit;
			if ($this->VehicleVisit->save($this->request->data)) {
				$this->Flash->success(__('The vehicle has been checked out.'),'default',array('class'=>'success'));
				return $this->redirect(array('controller' => 'vehicles','action' => 'view', $this->request->data['VehicleVisit']['vehicle_id']));
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
