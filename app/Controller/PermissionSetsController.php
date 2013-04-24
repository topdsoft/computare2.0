<?php
App::uses('AppController', 'Controller');
/**
 * PermissionSets Controller
 *
 * used to edit and add permission sets for users
 */
class PermissionSetsController extends AppController{

	public $components=array('ComputareUser');

	/**
	 * edit method
	 * @param int $id : id of permissionsSet to edit
	 */
	public function edit($id=null) {
		$this->set('formName','Edit Permissions');
		//validate
		$this->PermissionSet->id=$id;
		if(!$this->PermissionSet->exists()) throw new NotFoundException(__('Invalid set'));
		$permissionSet=$this->PermissionSet->read();
		$permissionList=$this->ComputareUser->getPermissionList();
		if ($this->request->is('post') || $this->request->is('put')) {
			//create array to pass (array contains names of permissions to be added, missing will be removed)
			$permData=array();
			foreach($permissionList as $p) if($this->request->data['PermissionSet'][$p]) $permData[]=$p;
			$ok=false;
			//save data
			if($permissionSet['PermissionSet']['user_id'] && $permissionSet['PermissionSet']['form_id'])
				$ok=$this->ComputareUser->setUserToFormPermission($permissionSet['PermissionSet']['user_id'],
				$permissionSet['PermissionSet']['form_id'],$permData,$this->Auth->user('id'));
			if($permissionSet['PermissionSet']['user_id'] && $permissionSet['PermissionSet']['formGroup_id'])
				$ok=$this->ComputareUser->setUserToFormGroupPermission($permissionSet['PermissionSet']['user_id'],
				$permissionSet['PermissionSet']['formGroup_id'],$permData,$this->Auth->User('id'));
			if($permissionSet['PermissionSet']['userGroup_id'] && $permissionSet['PermissionSet']['form_id'])
				$ok=$this->ComputareUser->setUserGroupToFormPermission($permissionSet['PermissionSet']['userGroup_id'],
				$permissionSet['PermissionSet']['form_id'],$permData,$this->Auth->user('id'));
			if($permissionSet['PermissionSet']['userGroup_id'] && $permissionSet['PermissionSet']['formGroup_id'])
				$ok=$this->ComputareUser->setUserGroupToFormGroupPermission($permissionSet['PermissionSet']['userGroup_id'],
				$permissionSet['PermissionSet']['formGroup_id'],$permData,$this->Auth->User('id'));
// debug($this->params);debug($permData);exit;
			if($ok) {
				//saved ok redirect back to original form
				$this->Session->setFlash(__('The permission changes been saved'),'default',array('class'=>'success'));
				$this->redirect($this->params->named['redirect']);
			} else {
				$this->Session->setFlash(__('Your permission changes could not be saved'));
			}//endif
		} else {
			$this->request->data['PermissionSet']=$permissionSet['PermissionSet'];
		}
// debug($set);exit;
		$this->set(compact('permissionSet','permissionList'));
	}
	
	/**
	 * addFormToUser method
	 * @param int $user_id
	 * @param redirect=>array('controller'=>controller,'action'=>action,id)
	 */
	public function addFormToUser($user_id) {
		$this->set('formName','Add Form Permission to User');
		$this->User=ClassRegistry::init('User');
		$this->Form=ClassRegistry::init('Form');
		$this->User->id=$user_id;
		if(!$this->User->exists()) throw new NotFoundException(__('Invalid user'));
		if ($this->request->is('post') || $this->request->is('put')) {
			//check if there is a record allready
			$set_id=$this->PermissionSet->field('id',array('form_id'=>$this->request->data['PermissionSet']['form_id'],'user_id'=>$user_id));
			if($set_id) $this->redirect(array('action'=>'edit',$set_id,'redirect'=>$this->params->named['redirect']));
			else {
				//create perm set but add no permissions
				$this->ComputareUser->setUserToFormPermission($user_id,$this->request->data['PermissionSet']['form_id'],array(),$this->Auth->user('id'));
				$this->redirect(array('action'=>'edit',$this->PermissionSet->getInsertId(),'redirect'=>$this->params->named['redirect']));
			}//endif
		}//endif
		$userName=$this->User->field('username',array('User.id'=>$user_id));
		$forms=$this->Form->find('list');
		$this->set(compact('forms','userName'));
	}
	
	/**
	 * addFormGroupToUser method
	 * @param int $user_id
	 * @param redirect=>array('controller'=>controller,'action'=>action,id)
	 */
	public function addFormGroupToUser($user_id) {
		$this->set('formName','Add Form Group Permission to User');
		$this->User=ClassRegistry::init('User');
		$this->FormGroup=ClassRegistry::init('FormGroup');
		$this->User->id=$user_id;
		if(!$this->User->exists()) throw new NotFoundException(__('Invalid user'));
		if ($this->request->is('post') || $this->request->is('put')) {
			//check if there is a record allready
			$set_id=$this->PermissionSet->field('id',array('formGroup_id'=>$this->request->data['PermissionSet']['formGroup_id'],'user_id'=>$user_id));
			if($set_id) $this->redirect(array('action'=>'edit',$set_id,'redirect'=>$this->params->named['redirect']));
			else {
				//create perm set but add no permissions
				$this->ComputareUser->setUserToFormGroupPermission($user_id,$this->request->data['PermissionSet']['formGroup_id'],array(),$this->Auth->user('id'));
				$this->redirect(array('action'=>'edit',$this->PermissionSet->getInsertId(),'redirect'=>$this->params->named['redirect']));
			}//endif
		}//endif
		$userName=$this->User->field('username',array('User.id'=>$user_id));
		$formGroups=$this->FormGroup->find('list');
		$this->set(compact('formGroups','userName'));
	}
}