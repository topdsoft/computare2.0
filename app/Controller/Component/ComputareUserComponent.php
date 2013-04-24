<?php
/**
 * ComputareUserComponent.php
 * 
 * Part of computare accounting system used to modify users, usergroups and permissions
 * */

App::uses('Component','Controller');
class ComputareUserComponent extends Component{
	public $components=array('ComputareSysevent');
	/**
	 * saveUser method
	 * @param $data
	 * @param $uid  //user id of current user (who is making changes)
	 * @return t/f
	 */
	public function saveUser($data,$uid) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$ok=true;
		$dataSource=$this->User->getDataSource();
		$oldData=$this->User->read(null,$data['User']['id']);
// debug($data);debug($oldData);exit;
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
				//user is new to this group - log changes
				$log['event_type']=4;
				$log['created_id']=$uid;
				$log['title']='User + Group';
				$log['permissionEvent']['user_id']=$data['User']['id'];
				$log['permissionEvent']['note']='ADDED TO GROUP: '.$this->UserGroup->field('name',array('id'=>$group));
// debug($log);exit;
				$this->ComputareSysevent->save($log);
				unset($log);
	//debug('addedto');debug($group);
				
			}//endif
		}//end foreach
		//find removed groups
		foreach($oldGroups as $group) {
			//loop through all previous groups
			if(!in_array($group['id'],$newGroups)) {
				//user has been removed from this group - log changes
				$log['event_type']=4;
				$log['created_id']=$uid;
				$log['title']='User - Group';
				$log['permissionEvent']['user_id']=$data['User']['id'];
				$log['permissionEvent']['note']='REMOVED FROM GROUP: '.$this->UserGroup->field('name',array('id'=>$group['id']));
// debug($log);exit;
				$this->ComputareSysevent->save($log);
				unset($log);
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
		'setLogging',
		'undoOwn',
		'undoOthers');
	}
	
	/** setUserToFormPermission
	 * @param int $user_id
	 * @param int $form_id
	 * @param array $permissions => array of perms to add (perms not in array will be removed)
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
	 * @param int $uid
	 * @return t/f 
	 */
	public function setUserToFormGroupPermission($user_id,$formGroup_id,$permissions,$uid) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->FormGroup=ClassRegistry::init('FormGroup');
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		//check for existing record
		$data=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('user_id'=>$user_id,'formGroup_id'=>$formGroup_id)));
//debug($data);exit;
		if(!$data) $data=array('PermissionSet'=>array('user_id'=>$user_id,'formGroup_id'=>$formGroup_id));
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
			$log['permissionEvent']['formGroup_id']=$formGroup_id;
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
			$log['permissionEvent']['formGroup_id']=$formGroup_id;
			$log['permissionEvent']['note']='REMOVED:';
			foreach($removed as $add) $log['permissionEvent']['note'].=$add.' ';
			$this->ComputareSysevent->save($log);
			unset($log);
// debug($removed);
		}//endif
// debug($data);
		return ($this->PermissionSet->save($data)==true);
	}//end public function setUserToFormGroupPermission

	/** setUserGroupToFormPermission
	 * @param int $userGroup_id
	 * @param int $form_id
	 * @param array $permissions
	 * @param int $uid
	 * @return t/f 
	 */
	public function setUserGroupToFormPermission($userGroup_id,$form_id,$permissions,$uid) {
		//get models
		$this->User=ClassRegistry::init('UserGroup');
		$this->Form=ClassRegistry::init('Form');
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		//check for existing record
		$data=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('userGroup_id'=>$userGroup_id,'form_id'=>$form_id)));
//debug($data);exit;
		if(!$data) $data=array('PermissionSet'=>array('userGroup_id'=>$userGroup_id,'form_id'=>$form_id));
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
			$log['permissionEvent']['userGroup_id']=$userGroup_id;
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
			$log['permissionEvent']['userGroup_id']=$userGroup_id;
			$log['permissionEvent']['form_id']=$form_id;
			$log['permissionEvent']['note']='REMOVED:';
			foreach($removed as $add) $log['permissionEvent']['note'].=$add.' ';
			$this->ComputareSysevent->save($log);
			unset($log);
// debug($removed);
		}//endif
// debug($data);
		return ($this->PermissionSet->save($data)==true);
	}//end public function setUserGroupToFormPermission

	/** setUserGroupToFormGroupPermission
	 * @param int $userGroup_id
	 * @param int $formGroup_id
	 * @param array $permissions
	 * @param int $uid
	 * @return t/f 
	 */
	public function setUserGroupToFormGroupPermission($userGroup_id,$formGroup_id,$permissions,$uid) {
		//get models
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$this->FormGroup=ClassRegistry::init('FormGroup');
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		//check for existing record
		$data=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('userGroup_id'=>$userGroup_id,'formGroup_id'=>$formGroup_id)));
// debug($data);exit;
		if(!$data) $data=array('PermissionSet'=>array('userGroup_id'=>$userGroup_id,'formGroup_id'=>$formGroup_id));
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
			$log['permissionEvent']['userGroup_id']=$userGroup_id;
			$log['permissionEvent']['formGroup_id']=$formGroup_id;
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
			$log['permissionEvent']['userGroup_id']=$userGroup_id;
			$log['permissionEvent']['formGroup_id']=$formGroup_id;
			$log['permissionEvent']['note']='REMOVED:';
			foreach($removed as $add) $log['permissionEvent']['note'].=$add.' ';
			$this->ComputareSysevent->save($log);
			unset($log);
// debug($removed);
		}//endif
// debug($data);
		return ($this->PermissionSet->save($data)==true);
	}//end public function setUserGroupToFormGroupPermission

	/** authenticate method
	 * @param int $form_id form to check
	 * @param int $user_id user to check
	 * @param string $action action user is trying (view, submit, etc)
	 */
	public function authenticate($form_id,$user_id,$action) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->Form=ClassRegistry::init('Form');
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$this->FormGroup=ClassRegistry::init('FormGroup');
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		//validate $action
		if(!in_array($action, $this->getPermissionList())) return false;
		$ok=false;
		#userid==1
		if($user_id==1) $ok=true;
		#check form_id vs user_id
		if(!$ok)$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('user_id'=>$user_id,'form_id'=>$form_id)));
		if(!$ok && $set) $ok=$set['PermissionSet'][$action];
		#check formGroup_id vs user_id
		if(!$ok) {
			//get formGroup_id
			$formGroup_id=$this->Form->field('formGroup_id',array('Form.id'=>$form_id));
			$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('user_id'=>$user_id,'formGroup_id'=>$formGroup_id)));
			if($set) $ok=$set['PermissionSet'][$action];
		}//endif
		#check each userGroup_id
		if(!$ok) {
			//get user groups
			$user=$this->User->find('first',array('recursive'=>1,'conditions'=>array('User.id'=>$user_id)));
			$userGroups=$user['UserGroup'];
			foreach($userGroups as $userGroup) {
				//loop for each of the groups the user belongs to
				$userGroup_id=$userGroup['id'];
				if(!$ok) {
					//check userGroup_id and form_id
					$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('userGroup_id'=>$userGroup_id,'form_id'=>$form_id)));
					if($set) $ok=$set['PermissionSet'][$action];
				}//endif
				if(!$ok) {
					//check userGroup_id and formGroup_id
					$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('userGroup_id'=>$userGroup_id,'formGroup_id'=>$formGroup_id)));
					if($set) $ok=$set['PermissionSet'][$action];
				}//endif
			}//end foreach
// debug($userGroups);exit;
		}//endif
		//return
		return $ok;
	}//end public function authenticate
	
	/**
	 * getToken method
	 * @param int $form_id
	 * @param int $user_id
	 * @return array(
		* [form_id] (probably not needed)
		* [user_id] (ditto)
		* [{each action as returned by $this->getPermissionList()}]=>t/f if this user has permissions
	 * )
	 */
	public function getToken($form_id,$user_id) {
		//get models
		$this->User=ClassRegistry::init('User');
		$this->Form=ClassRegistry::init('Form');
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$this->FormGroup=ClassRegistry::init('FormGroup');
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		//validation
#TO DO
		$toReturn=array('user_id'=>$user_id,'form_id'=>$form_id);//array to return
		$toCheck=$this->getPermissionList();//remove from list when checked
		//start with all true for uid==1 (and return here), all false for everyone else
		foreach($toCheck as $i=>$p) {
			//loop for all perms
			$toReturn[$p]=($user_id==1);
			if($user_id==1) unset($toCheck[$i]);
		}//endforeach
		if(empty($toCheck)) return $toReturn;
		//check individual user to individual form
		$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('user_id'=>$user_id,'form_id'=>$form_id)));
		if($set)$toReturn=$this->checkSet($toCheck,$set,$toReturn);
		if(empty($toCheck)) return $toReturn;
		#check formGroup_id vs user_id
		$formGroup_id=$this->Form->field('formGroup_id',array('Form.id'=>$form_id));
		$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('user_id'=>$user_id,'formGroup_id'=>$formGroup_id)));
		if($set)$toReturn=$this->checkSet($toCheck,$set,$toReturn);
		if(empty($toCheck)) return $toReturn;
		#check each userGroup_id
		$user=$this->User->find('first',array('recursive'=>1,'conditions'=>array('User.id'=>$user_id)));
		//get user groups
		$userGroups=$user['UserGroup'];
		foreach($userGroups as $userGroup) {
			//loop for each of the groups the user belongs to
			$userGroup_id=$userGroup['id'];
			//check userGroup_id and form_id
			$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('userGroup_id'=>$userGroup_id,'form_id'=>$form_id)));
			if($set)$toReturn=$this->checkSet($toCheck,$set,$toReturn);
			if(empty($toCheck)) return $toReturn;
			//check userGroup_id and formGroup_id
			$set=$this->PermissionSet->find('first',array('recursive'=>-1,'conditions'=>array('userGroup_id'=>$userGroup_id,'formGroup_id'=>$formGroup_id)));
			if($set)$toReturn=$this->checkSet($toCheck,$set,$toReturn);
			if(empty($toCheck)) return $toReturn;
		}//end foreach

		return $toReturn;
	}
	
	/**
	 * checkSet method
	 * @param array $toCheck
	 * @param array $set
	 * @param array $toReturn
	 * used as a helper for getToken: checks list in toCheck against $set.  If true it sets $toReturn =true and removes from $toCheck
	 */
	private function checkSet($toCheck,$set,$toReturn) {
		foreach($toCheck as $i=>$p) {
			//loop for all remaining perms and check
			if($set['PermissionSet'][$p]) {
				//user has this permission
				$toReturn[$p]=true;
				unset($toCheck[$i]);//no need to check again
			}//endif
		}//endforeach
		return $toReturn;
	}
}