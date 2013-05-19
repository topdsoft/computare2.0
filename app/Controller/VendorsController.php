<?php
App::uses('AppController', 'Controller');
/**
 * Vendors Controller
 *
 * @property Vendor $Vendor
 */
class VendorsController extends AppController {

	public $components=array('ComputareAP');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Vendors');
		$this->Vendor->recursive = 0;
		$this->set('vendors', $this->paginate());
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
		$this->set('formName','View Vendor');
		$this->Vendor->id = $id;
		if (!$this->Vendor->exists()) {
			throw new NotFoundException(__('Invalid vendor'));
		}
		$this->set('vendor', $this->Vendor->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',$this->Vendor->Item->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Vendor');
		if ($this->request->is('post')) {
			$this->Vendor->create();
// debug($this->request->data);exit;
			if ($this->ComputareAP->saveVendor($this->request->data)) {
				$this->Session->setFlash(__('The vendor has been saved'),'default',array('class'=>'success'));
				if(isset($this->params->named['redirect'])) {
					//will redirect back to calling form
					$redirect=$this->params->named['redirect'];
					if(isset($redirect['id']) && $redirect['id']=='NEW') $redirect['id']=$this->Vendor->getInsertId();
					if(isset($redirect['id'])) {
						//fix id
						$ret_id=$redirect['id'];
						unset($redirect['id']);
						$redirect+=array($ret_id);
// debug($redirect);debug($ret_id);exit;
						unset($ret_id);
					}//endif
					$this->redirect($redirect);
				}//endif
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vendor could not be saved. Please, try again.'));
			}
		}
		$glAccounts=array(null=>'(none, use default)')+ClassRegistry::init('Glaccount')->find('list');
		$this->set(compact('glAccounts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Vendor');
		$this->Vendor->id = $id;
		if (!$this->Vendor->exists()) {
			throw new NotFoundException(__('Invalid vendor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			if ($this->ComputareAR->saveVendor($this->request->data)) {
				$this->Session->setFlash(__('The vendor has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vendor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Vendor->read(null, $id);
		}
// 		$items = $this->Vendor->Item->find('list');
// 		$this->set(compact('items'));
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
		$this->Vendor->id = $id;
		if (!$this->Vendor->exists()) {
			throw new NotFoundException(__('Invalid vendor'));
		}
		if ($this->Vendor->delete()) {
			$this->Session->setFlash(__('Vendor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vendor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
