<?php
App::uses('AppController', 'Controller');
/**
 * Services Controller
 *
 * @property Service $Service
 */
class ServicesController extends AppController {

	public $components=array('ComputareAR');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Services');
		$this->set('add_menu',true);
		$this->set('helplink','/pages/services#l');
		$this->Service->recursive = 0;
		$this->set('services', $this->paginate(array('Service.active')));
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('pricingOptions',$this->Service->getPricingOptions());
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Create Service');
		$this->set('add_menu',true);
		$this->set('helplink','/pages/services#a');
		if ($this->request->is('post')) {
			//saving
			$this->Service->create();
			$this->request->data['Service']['created_id']=$this->Auth->user('id');
			$this->request->data['Service']['active']=true;
			if ($this->Service->save($this->request->data)) {
				//validatio ok
				$this->Session->setFlash(__('The service has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				//validation failed
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data['Service']=$this->passedArgs;
		}//endif
		$this->set('pricingOptions',$this->Service->getPricingOptions());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function edit($id = null) {
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Service->read(null, $id);
		}
	}
 */

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->set('formName','Remove Service');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->Service->save(array('active'=>false))) {
			$this->Session->setFlash(__('Service deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Service was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
