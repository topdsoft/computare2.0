<?php
App::uses('AppController', 'Controller');
/**
 * IssueTypes Controller
 *
 * @property IssueType $IssueType
 */
class IssueTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Issue Types');
		$this->set('menu_add',true);
		$this->IssueType->recursive = 0;
		$this->set('issueTypes', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Issue type');
		$this->set('menu_add',true);
		if ($this->request->is('post')) {
			$this->IssueType->create();
			$this->request->data['IssueType']['created_id']=$this->Auth->user('id');
			$this->request->data['IssueType']['active']=true;
			if ($this->IssueType->save($this->request->data)) {
				$this->Session->setFlash(__('The issue type has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue type could not be saved. Please, try again.'));
			}
		}
		$glAccounts = $this->IssueType->Glaccount->find('list');
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
