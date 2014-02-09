<?php
App::uses('AppController', 'Controller');
/**
 * Invoices Controller
 *
 * @property Invoice $Invoice
 */
class InvoicesController extends AppController {

	public $components=array('ComputareAP');
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
		$this->set('users',array(null=>'')+ClassRegistry::init('User')->find('list'));
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
		$invoice=$this->Invoice->read(null, $id);
		if ($this->request->is('post') || $this->request->is('put')) {
			if($invoice['Vendor']['id']) {
				//AP
				$this->request->data['Invoice']['invoice_id']=$this->request->data['Invoice']['id'];
				if($this->ComputareAP->invoicePayment($this->request->data['Invoice'])) {
					$this->Session->setFlash(__('Payment on Invoice saved'),'default',array('class'=>'success'));
					if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Payment could not be saved.'));
				}//endif
			} else {
				//AR
			}//endif
debug($this->request->data);exit;

		} else {
			$this->request->data=$invoice;
			$this->request->data['Invoice']['payment']=$invoice['Invoice']['total'];
// 			exit;
		}//endif
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('invoice', $invoice);
	}//end function payment
	
}
