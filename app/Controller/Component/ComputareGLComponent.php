<?php
/**
 * ComputareGLComponent.php
 * 
 * Part of computare accounting system used to support general ledger transactions and accounts
 * */

App::uses('Component','Controller');
class ComputareGLComponent extends Component{
	/**
	 * saveGroup method
	 * @param $data
	 * used to save group data
	 */
	public function saveGroup($data){
		//save gl group data
		$this->Glgroup=ClassRegistry::init('Glgroup');
		if(isset($data['Glgroup']['created_id'])) return $this->Glgroup->save($data);
		return false;
debug($data);exit;
	}//end function saveGroup
	
	/**
	 * saveAccount method
	 * @param $data
	 * used to save account data
	 */
	public function saveAccount($data){
		
	}
	
	/**
	 * post method
	 * @param $data
	 * used to post to general ledger
	 */
	public function post($data){
		
	}
}