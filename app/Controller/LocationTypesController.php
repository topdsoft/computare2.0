<?php
App::uses('AppController', 'Controller');
/**
 * LocationTypes Controller
 *
 * @property LocationType $LocationType
 */
class LocationTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Location Types');
		$this->set('menu_add',true);
		$this->LocationType->recursive = 0;
		$this->set('locationTypes', $this->paginate(array('LocationType.active')));
		//get users list
		$this->set('users',ClassRegistry::init('User')->find('list'));
		//get locations list
		$this->set('locations',array(null=>'')+ClassRegistry::init('Location')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Location Type');
		if ($this->request->is('post')) {
			//save data
			$this->LocationType->create();
			$this->request->data['LocationType']['created_id']=$this->Auth->user('id');
			if($this->request->data['LocationType']['default_name']=='') unset($this->request->data['LocationType']['default_name']);
			if($this->request->data['LocationType']['next_number']=='') unset($this->request->data['LocationType']['next_number']);
			if ($this->LocationType->save($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The location type has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//validation fail
				$this->Session->setFlash(__('The location type could not be saved. Please, try again.'));
			}//endif
		} else {
			//get default
			$this->request->data['LocationType']=$this->passedArgs;
		}//endif
		//get locations list
		$this->set('locations',array(null=>'(none)')+ClassRegistry::init('Location')->generateTreeList(null,null,null,'-'));
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
		$this->set('formName','Remove Location Type');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->LocationType->id = $id;
		if (!$this->LocationType->exists()) {
			throw new NotFoundException(__('Invalid location type'));
		}
		$locationType=$this->LocationType->read(null,$id);
		$locationType['LocationType']['active']=false;
		$locationType['LocationType']['removed']=date('Y-m-d H:i:s');
		$locationType['LocationType']['removed_id']=$this->Auth->user('id');
		if ($this->LocationType->save($locationType)) {
			$this->Session->setFlash(__('Location type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Location type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
