<?php
App::uses('AppController', 'Controller');
/**
 * Vehicles Controller
 *
 * @property Vehicle $Vehicle
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class VehiclesController extends AppController {

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
		$this->set('formName','List Vehicles');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',true);
		$this->Vehicle->recursive = 0;
		$this->set('vehicles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Vehicle');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',false);
		if (!$this->Vehicle->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle'));
		}
		$options = array('conditions' => array('Vehicle.' . $this->Vehicle->primaryKey => $id));
		$this->set('vehicle', $this->Vehicle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Vehicle');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',true);
		if ($this->request->is('post')) {
			$this->Vehicle->create();
			$this->request->data['Vehicle']['created_id']=$this->Auth->user('id');
			if ($this->Vehicle->save($this->request->data)) {
				$this->Flash->success(__('The vehicle has been saved.'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
			}
		} else {
			//check for default values
			$this->request->data['Vehicle']=$this->passedArgs;
		}
		$customers = $this->Vehicle->Customer->find('list');
		$images = $this->Vehicle->Image->find('list');
		$this->set(compact('customers', 'images'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Vehicle');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',false);
		if (!$this->Vehicle->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vehicle->save($this->request->data)) {
				$this->Flash->success(__('The vehicle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vehicle.' . $this->Vehicle->primaryKey => $id));
			$this->request->data = $this->Vehicle->find('first', $options);
		}
		$customers = $this->Vehicle->Customer->find('list');
		$images = $this->Vehicle->Image->find('list');
		$this->set(compact('customers', 'images'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->set('formName','Delete Vehicle');
//		$this->set('helplink','/pages/salesOrders#l');
		$this->set('add_menu',false);
		if (!$this->Vehicle->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Vehicle->delete($id)) {
			$this->Flash->success(__('The vehicle has been deleted.'));
		} else {
			$this->Flash->error(__('The vehicle could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
