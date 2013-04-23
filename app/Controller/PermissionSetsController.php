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
}