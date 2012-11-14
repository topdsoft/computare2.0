<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {

	
	public $components=array('ComputareCustomer');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Customers');
		if ($this->request->is('post') || $this->request->is('put')) {
			//respond to filter requests
			$this->passedArgs['showDeleted']=$this->request->data['Customer']['showDeleted'];
			$this->redirect($this->passedArgs);
		} else {
			//check passed params
			if(isset($this->passedArgs['showDeleted'])) $this->request->data['Customer']['showDeleted']=$this->passedArgs['showDeleted'];
			else $this->request->data['Customer']['showDeleted']=false;
		}//endif
		$this->Customer->recursive = 0;
		//setup filters
		$conditions=array();
		//filter deleted customers
		if(!$this->request->data['Customer']['showDeleted']) $conditions[]='Customer.active';
		$this->set('customers', $this->paginate('Customer',$conditions));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Customer');
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->Customer->bindModel(array('hasMany'=>array('Revisions'=>array(
			'className'=>'CustomerDetail',
			'order'=>'Revisions.id desc'))));
		$this->set('customer', $this->Customer->read(null, $id));
		//get users list for showing created and deleted id
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('users'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//adding customer uses the edit function with null id
		$this->set('formName','Add New Customer');
		$this->redirect(array('action' => 'edit'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Customer');
		//if $id not set we are adding a new customer
		if($id) {
			//validate $id
			$this->Customer->id = $id;
			if (!$this->Customer->exists()) {
				throw new NotFoundException(__('Invalid customer'));
			}
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//save data
			$this->request->data['CustomerDetail']['created_id']=$this->Auth->user('id');
			if ($this->ComputareCustomer->save($this->request->data)){
				$this->Session->setFlash(__('The customer has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Customer->read(null, $id);
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
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->ComputareCustomer->delete($id,$this->Auth->user('id'))) {
			$this->Session->setFlash(__('Customer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Customer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
