<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * login controller
 */
	public function login() {
		$this->layout='login';
		if ($this->request->is('post')) {
			//save company in session data
			$company=$this->request->data['User']['company'];
			Configure::write('Company',$company);
			$this->Session->write('Company',$company);
//debug();debug($this->Session->read('company'));exit;
			//before handing off to the auth component, make sure db connection is good
			App::Import('Model','ConnectionManager');
			$config = ConnectionManager::getDataSource('default')->config;
//debug($config);
			$config['database'] = $company;
			$results=true;
			try {$results=ConnectionManager::create($company, $config);}
			catch (Exception $e) {$results=false;}
//debug($results);exit;
			if($results) {
				if ($this->Auth->login()) {
//debug($this->Auth->user());exit;
					return $this->redirect($this->Auth->redirect());
				} else {
					$this->Session->setFlash(__('Your Credentials are incorrect'), 'default', array(), 'auth');
				}
			} else {
				$this->Session->setFlash(__('Company is incorrect'), 'default', array(), 'auth');
				$this->User->useTable=false;
			}
		} else {
			//need to set database name 
			$this->User->useTable=false;
		}
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}
