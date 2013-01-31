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
		$this->Sysevent->recursive = 0;
		$this->set('sysevents', $this->paginate());
		$this->set('eventTypes', $this->Sysevent->getEventTypes());
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
	}

}
