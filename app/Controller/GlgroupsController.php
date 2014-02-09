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
		$this->set('formName','List GL Account Groups');
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
		$this->set('formName','View GL Account Group');
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
		$this->set('formName','Add GL Account Group');
		if ($this->request->is('post')) {
			//save data
			$this->request->data['Glgroup']['created_id']=$this->Auth->user('id');
			if ($this->ComputareGL->saveGroup($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The glgroup has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//validation failed
				$this->Session->setFlash(__('The GL Group could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data['Glgroup']=$this->passedArgs;
		}//endif
	}

}
