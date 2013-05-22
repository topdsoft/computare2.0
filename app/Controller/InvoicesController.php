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
	}

}
