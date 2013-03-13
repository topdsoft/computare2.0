<?php
/**
 * ComputareUserComponent.php
 * 
 * Part of computare accounting system used to modify users and usergroups
 * */

App::uses('Component','Controller');
class ComputareUserComponent extends Component{
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
}