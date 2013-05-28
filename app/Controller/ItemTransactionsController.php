<?php
App::uses('AppController', 'Controller');
/**
 * ItemTransactions Controller
 *
 * @property ItemTransaction $ItemTransaction
 */
class ItemTransactionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','Item Transactions');
		$this->set('add_menu',true);
		$this->ItemTransaction->recursive = 0;
		$this->set('itemTransactions', $this->paginate());
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
		$this->set('formName','Transaction Details');
		$this->ItemTransaction->id = $id;
		if (!$this->ItemTransaction->exists()) {
			throw new NotFoundException(__('Invalid item transaction'));
		}
		$this->set('itemTransaction', $this->ItemTransaction->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}


}
