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
		$this->Glgroup->create();
		if(isset($data['Glgroup']['created_id'])) return ($this->Glgroup->save($data)==true);
		return false;
	}//end function saveGroup
	
	/**
	 * saveAccount method
	 * @param $data
	 * used to save account data
	 */
	public function saveAccount($data){
		//verify created_id
		if(!isset($data['GlaccountDetail']['created_id'])) return false;
		//get models
		$this->Glaccount=ClassRegistry::init('Glaccount');
		$this->GlaccountDetail=ClassRegistry::init('GlaccountDetail');
		$ok=true;
		$dataSource=$this->Glaccount->getDataSource();
		//start transaction
		$dataSource->begin();
		//check if existing or new account
		if($data['Glaccount']['id']) {
			//existing account
			$this->GlaccountDetail->create();
			$ok=$this->GlaccountDetail->save($data['GlaccountDetail']);
			$detail_id=$this->GlaccountDetail->getInsertId();
			//link new detail back to account
			if($ok) $ok=$this->Glaccount->save(array('id'=>$data['GlaccountDetail']['glaccount_id'],'glaccountDetail_id'=>$detail_id));
		} else {
			//new account
			$this->Glaccount->create();
			$ok=$this->Glaccount->save(array('created_id'=>$data['GlaccountDetail']['created_id'],'glaccountDetail_id'=>0));
			$account_id=$this->Glaccount->getInsertId();
			//save account details
			$data['GlaccountDetail']['glaccount_id']=$account_id;
			$this->GlaccountDetail->create();
			if($ok) $ok=$this->GlaccountDetail->save($data['GlaccountDetail']);
			$detail_id=$this->GlaccountDetail->getInsertId();
			//link new detail back to account
			if($ok) $ok=$this->Glaccount->save(array('id'=>$account_id,'glaccountDetail_id'=>$detail_id));
		}//endif
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/**
	 * post method
	 * @param $data
	 * used to post to general ledger
	 */
	public function post($data){
		
	}
}