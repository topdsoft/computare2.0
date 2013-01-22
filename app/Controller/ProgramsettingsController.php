<?php
App::uses('AppController', 'Controller');
/**
 * Programsettings Controller
 *
 * @property Programsetting $Programsetting
 */
class ProgramsettingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','Program Setting History');
		$this->Programsetting->recursive = 0;
		$this->set('programsettings', $this->paginate());
		$this->set('userlist', ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function view($id = null) {
		$this->Programsetting->id = $id;
		if (!$this->Programsetting->exists()) {
			throw new NotFoundException(__('Invalid programsetting'));
		}
		$this->set('programsetting', $this->Programsetting->read(null, $id));
	}
 */

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Inital Program Settings');
		if ($this->request->is('post')) {
			//set user id
			$this->request->data['Programsetting']['created_id']=$this->Auth->user('id');
			$this->request->data['Programsetting']['dbschema']=0;
			$this->Programsetting->create();
			if ($this->Programsetting->save($this->request->data)) {
				$this->Session->setFlash(__('The initial program settings have been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programsetting could not be saved. Please, try again.'));
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
		$this->set('formName','Edit Program Settings');
		$this->Programsetting->id = $id;
		if (!$this->Programsetting->exists()) {
			throw new NotFoundException(__('Invalid programsetting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Programsetting->save($this->request->data)) {
				$this->Session->setFlash(__('The programsetting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programsetting could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Programsetting->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Programsetting->id = $id;
		if (!$this->Programsetting->exists()) {
			throw new NotFoundException(__('Invalid programsetting'));
		}
		if ($this->Programsetting->delete()) {
			$this->Session->setFlash(__('Programsetting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Programsetting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
 */
}
