<?php
App::uses('AppController', 'Controller');
/**
 * UserGroups Controller
 *
 * @property Group $Group
 */
class UserGroupsController extends AppController {

	public $components=array('ComputareSysevent','ComputareUser');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List User Groups');
		$this->set('add_menu',true);
		$this->UserGroup->recursive = 0;
		$this->set('groups', $this->paginate());
		$this->set('users',$this->UserGroup->User->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View User Group');
		$this->UserGroup->id = $id;
		if (!$this->UserGroup->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->set('group', $this->UserGroup->read(null, $id));
		$this->set('users',$this->UserGroup->User->find('list'));
		//get permissions
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		$this->set('permissions',$this->PermissionSet->find('all',array('conditions'=>array('userGroup_id'=>$id))));
		$this->set('permissionsList',$this->ComputareUser->getPermissionList());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add User Group');
		$this->set('add_menu',true);
		if ($this->request->is('post')) {
			$this->request->data['UserGroup']['created_id']=$this->Auth->user('id');
//debug($this->request->data);exit;
			if ($this->ComputareUser->saveUserGroup($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}//endif
		} else {
			//set defaults
			$this->request->data['UserGroup']=$this->passedArgs;
		}//endif
//		$forms = $this->UserGroup->Form->find('list');
//		$users = $this->UserGroup->User->find('list');
//		$this->set(compact('forms', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit User Group');
		$this->UserGroup->id = $id;
		if (!$this->UserGroup->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['UserGroup']['created_id']=$this->Auth->user('id');
			if ($this->ComputareUser->saveUserGroup($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserGroup->read(null, $id);
		}
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		$permissions=$this->PermissionSet->find('all',array('conditions'=>array('userGroup_id'=>$id)));
		$permissionsList=$this->ComputareUser->getPermissionList();
		$users = $this->UserGroup->User->find('list');
		$this->set(compact('permissions','permissionsList', 'users'));
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
		$this->set('formName','Delete User Group');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
