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
			//save data
			$this->ReceiptType->create();
			$this->request->data['ReceiptType']['created_id']=$this->Auth->user('id');
			$this->request->data['ReceiptType']['active']=true;
			if ($this->ReceiptType->save($this->request->data)) {
				//valadation ok
				$this->Session->setFlash(__('The receipt type has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//valadation fail
				$this->Session->setFlash(__('The receipt type could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data['ReceiptType']=$this->passedArgs;
		}//endif
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
