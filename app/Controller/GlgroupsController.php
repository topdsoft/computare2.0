<?php
App::uses('AppController', 'Controller');
/**
 * Glgroups Controller
 *
 * @property Glgroup $Glgroup
 */
class GlgroupsController extends AppController {

	public $components=array('ComputareGL');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Glgroup->recursive = 0;
		$this->set('glgroups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Glgroup->id = $id;
		if (!$this->Glgroup->exists()) {
			throw new NotFoundException(__('Invalid glgroup'));
		}
		$this->set('glgroup', $this->Glgroup->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Glgroup']['created_id']=$this->Auth->user('id');
			if ($this->ComputareGL->saveGroup($this->request->data)) {
				$this->Session->setFlash(__('The glgroup has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The GL Group could not be saved. Please, try again.'));
			}
		}
	}

}
