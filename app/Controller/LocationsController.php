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
		//get location data
		$location=$this->Location->read(null, $id);
		$this->set('location', $location);
		//get items at location
		$this->Location->ItemsLocation->bindModel(array('belongsTo'=>array('Location'=>array('foreignKey'=>'location_id','fields'=>array('id','name')),'Item'=>array('foreignKey'=>'item_id','fields'=>array('id','name')))));
		$il=$this->Location->ItemsLocation->find('all',array('conditions'=>array('location_id >='=>$location['Location']['lft'],'location_id <='=>$location['Location']['rght'])));
// debug($il);exit;
		$this->set('items',$il);
		//get path
		$this->set('path',$this->Location->getPath());
		//check for locks
		if($this->ComputareIC->checklock($id)) {
			//location is locked
			$this->Session->setFlash(__('This location is locked'),'default',array('class'=>'notice'));
		}//endif
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
			if(isset($this->params['named']['locationType_id'])) {
				//location type has been passed in
				$this->request->data['LocationDetail']['locationType_id']=$this->params['named']['locationType_id'];
			}//endif
			if ($this->ComputareIC->saveLocation($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'),'default',array('class'=>'success'));
				if(isset($this->params['named']['redirect'])) $this->redirect($this->params['named']['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else $this->request->data['Location']['parent_id']=$defaultParent;
// 		$locationDetails = $this->Location->LocationDetail->find('list');
		$parents = array(0=>'(none)')+$this->Location->ParentLocation->find('list');
// debug($parents);exit;
//		$parents[0]='(none)';
// 		$items = $this->Location->Item->find('list');
		$this->set(compact('parents'));
		//get list of location types
		$this->set('locationTypes',array(null=>'(none)')+$this->Location->LocationType->find('list',array('conditions'=>array('LocationType.active'))));
		//check for passed type
		if(isset($this->params['named']['locationType_id'])) {
			//get defaults for location type
			$locationType=$this->Location->LocationType->read(null,$this->params['named']['locationType_id']);
// debug($locationType);
			if($locationType['LocationType']['default_name']) {
				//use a name
				$this->request->data['LocationDetail']['name']=$locationType['LocationType']['default_name'];
			}//endif
			if($locationType['LocationType']['next_number']!=null) {
				//use a name
				$this->request->data['LocationDetail']['name'].=$locationType['LocationType']['next_number'];
			}//endif
			if($locationType['LocationType']['location_id']) $this->request->data['Location']['parent']=$locationType['LocationType']['location_id'];
			$this->set('locationType',$locationType);
		}//endif
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
