<?php
/**
 * ComputareUserComponent.php
 * 
 * Part of computare accounting system used to modify users and usergroups
 * */

App::uses('Component','Controller');
class ComputareUserComponent extends Component{
	public $components=array('ComputareSysevent');
	/**
	 * saveUser method
	 * @param $data
	 * @return t/f
	 */
	public function saveUser($data) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$ok=true;
		$dataSource=$this->User->getDataSource();
		$oldData=$this->User->read(null,$data['User']['id']);
//debug($data);debug($oldData);exit;
		//start transaction
		$dataSource->begin();
		$ok=$this->User->save($data);
		//figure out permission changes
		$newGroups=$data['UserGroup']['UserGroup'];
		if($newGroups=='')$newGroups=array();
		$oldGroups=$oldData['UserGroup'];
		//find newly added groups
		foreach($newGroups as $group) {
			//loop through all new groups
			$found=false;
			foreach($oldGroups as $og) if($group==$og['id']) $found=true;
			if(!$found) {
				//user is new to this group
//debug('addedto');debug($group);
				
			}//endif
		}//end foreach
		//find removed groups
		foreach($oldGroups as $group) {
			//loop through all previous groups
			if(!in_array($group['id'],$newGroups)) {
				//user has been removed from this group
//debug('removed from');debug($group);
				
			}//endif
		}//end foreach
//debug($newGroups);debug($oldGroups);exit;
		//finish transaction
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/** saveUserGroup method
	 * @param $data
	 * @returnt/f
	 */
	public function saveUserGroup($data) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$ok=true;
		$dataSource=$this->UserGroup->getDataSource();
//debug($data);exit;
		//start transaction
		$dataSource->begin();
		$ok=$this->UserGroup->save($data);
		//finish transaction
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/** getPermissionList
	 * @return array of valid permissions (no index)
	 */
	public function getPermissionList() {
		return array('view',
		'submit',
		'setDefault',
		'viewLogging',
		'undoOwn',
		'undoOthers');
	}
	
	/** setUserToFormPermission
	 * @param int $user_id
	 * @param int $form_id
	 * @param array $permissions => array of perms to add
	 * @param int $uid => current user
	 * @return t/f 
	 */
	public function setUserToFormPermission($user_id,$form_id,$permissions,$uid) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->Form=ClassRegistry::init('Form');
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		//check for existing record
		$data=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('user_id'=>$user_id,'form_id'=>$form_id)));
//debug($data);exit;
		if(!$data) $data=array('PermissionSet'=>array('user_id'=>$user_id,'form_id'=>$form_id));
		//set and record permission adds
		$added=array();
		foreach ($permissions as $p) {
			//loop for all incomming permissions to check if they are new
			if(!array_key_exists($p,$data['PermissionSet']) || ($data['PermissionSet'][$p]==false)) {
				//this perm has been added
				$added[]=$p;
			}//endif
			$data['PermissionSet'][$p]=true;
		}//end foreach
		if($added) {
			//log changes
			$log['event_type']=4;
			$log['created_id']=$uid;
			$log['title']='Perm(s) Added';
			$log['permissionEvent']['user_id']=$user_id;
			$log['permissionEvent']['form_id']=$form_id;
			$log['permissionEvent']['note']='ADDED:';
			foreach($added as $add) $log['permissionEvent']['note'].=$add.' ';
			$this->ComputareSysevent->save($log);
			unset($log);
// debug($added);
		}//endif
//debug($data);
		//record permission removals
		$removed=array();
		$permList=$this->getPermissionList();
		foreach ($permList as $p) {
			//loop for all available permissions to check if they are missing from incomming set
			if(!in_array($p,$permissions) && array_key_exists($p,$data['PermissionSet']) && $data['PermissionSet'][$p]==true) {
				//remove this permission
				$removed[]=$p;
				$data['PermissionSet'][$p]=false;
			}//endif
		}//end foreach
		//save
		if($removed) {
			//log changes
			$log['event_type']=4;
			$log['created_id']=$uid;
			$log['title']='Perm(s) Removed';
			$log['permissionEvent']['user_id']=$user_id;
			$log['permissionEvent']['form_id']=$form_id;
			$log['permissionEvent']['note']='REMOVED:';
			foreach($removed as $add) $log['permissionEvent']['note'].=$add.' ';
			$this->ComputareSysevent->save($log);
			unset($log);
// debug($removed);
		}//endif
// debug($data);
		return ($this->PermissionSet->save($data)==true);
	}//end public function setUserToFormPermission

	/** setUserToFormGroupPermission
	 * @param int $user_id
	 * @param int $formGroup_id
	 * @param array $permissions
	 * @return t/f 
	 */
	public function setUserToFormGroupPermission($user_id,$formGroup_id,$permissions) {
		
	}//end public function setUserToFormGroupPermission

	/** setUserGroupToFormPermission
	 * @param int $userGroup_id
	 * @param int $form_id
	 * @param array $permissions
	 * @return t/f 
	 */
	public function setUserGroupToFormPermission($userGroup_id,$form_id,$permissions) {
		
	}//end public function setUserGroupToFormPermission

	/** setUserGroupToFormGroupPermission
	 * @param int $userGroup_id
	 * @param int $formGroup_id
	 * @param array $permissions
	 * @return t/f 
	 */
	public function setUserGroupToFormGroupPermission($userGroup_id,$formGroup_id,$permissions) {
		
	}//end public function setUserGroupToFormGroupPermission

}