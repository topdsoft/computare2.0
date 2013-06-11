<?php
App::uses('AppController', 'Controller');
/**
 * Sysevents Controller
 *
 * @property Sysevent $Sysevent
 */
class SyseventsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List System Events');
		$eventTypes=$this->Sysevent->getEventTypes();
		//use filters
		$filters=array();
		$filters[]=array('type'=>3,
			'label'=>'Date',
			'passName'=>'created',
			'field'=>'Sysevent.created');
		$filters[]=array('type'=>1,
			'label'=>'Event Type',
			'passName'=>'eventType',
			'field'=>'Sysevent.event_type',
			'options'=>$eventTypes
		);
		$this->_useFilter($filters);//*/
		$this->Sysevent->recursive = 0;
//debug($this->conditions);
		$this->set('sysevents', $this->paginate('Sysevent',$this->conditions));
		$this->set('eventTypes', $eventTypes);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View System Event');
		$this->Sysevent->id = $id;
		if (!$this->Sysevent->exists()) {
			throw new NotFoundException(__('Invalid sysevent'));
		}
		$this->set('sysevent', $this->Sysevent->read(null, $id));
		$this->set('eventTypes', $this->Sysevent->getEventTypes());
		$this->set('users', array(null=>'')+ClassRegistry::init('User')->find('list'));
		$this->set('userGroups', ClassRegistry::init('UserGroup')->find('list'));
		$this->set('forms', ClassRegistry::init('Form')->find('list'));
		$this->set('formGroups', ClassRegistry::init('FormGroup')->find('list'));
	}

}
