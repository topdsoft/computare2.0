<?php
App::uses('AppController', 'Controller');
/**
 * ReceiptTypes Controller
 *
 * @property IssueType $IssueType
 */
class ReceiptTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Receipt Types');
		$this->set('menu_add',true);
		$this->ReceiptType->recursive = 0;
		$this->set('receiptTypes', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Receipt type');
		$this->set('menu_add',true);
		if ($this->request->is('post')) {
			$this->ReceiptType->create();
			$this->request->data['ReceiptType']['created_id']=$this->Auth->user('id');
			$this->request->data['ReceiptType']['active']=true;
			if ($this->ReceiptType->save($this->request->data)) {
				$this->Session->setFlash(__('The receipt type has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receipt type could not be saved. Please, try again.'));
			}
		}
		$glAccounts = $this->ReceiptType->Glaccount->find('list');
		$this->set(compact('glAccounts'));
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
		$this->set('formName','Remove issue Type');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->IssueType->id = $id;
		if (!$this->IssueType->exists()) {
			throw new NotFoundException(__('Invalid issue type'));
		}
		if ($this->IssueType->delete()) {
			$this->Session->setFlash(__('Issue type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Issue type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
