<?php
App::uses('AppController', 'Controller');
/**
 * Invoices Controller
 *
 * @property Invoice $Invoice
 */
class InvoicesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Invoices');
		$this->set('menu_add',true);
		$this->Invoice->recursive = 0;
		$this->set('invoices', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Invoice');
		$this->Invoice->id = $id;
		if (!$this->Invoice->exists()) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		$this->set('invoice', $this->Invoice->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/** 
 * payment method
 * 
 * @param $id
 */
	public function payment($id = null) {
		//record payment on Invoice
		$this->set('formName','Invoice Payment');
		$this->Invoice->id = $id;
		if (!$this->Invoice->exists()) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		$this->set('invoice', $this->Invoice->read(null, $id));
		
	}//end function payment
	
}
