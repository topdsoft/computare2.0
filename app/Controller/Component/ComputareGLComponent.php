<?php
/**
 * ComputareGLComponent.php
 * 
 * Part of computare accounting system used to support general ledger transactions and accounts
 * */

App::uses('Component','Controller');
class ComputareGLComponent extends Component{
	public $components = array('Auth', 'Session', 'Cookie');
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
			if($ok) $ok=$this->Glaccount->save(array('id'=>$data['GlaccountDetail']['glaccount_id'],'glaccountDetail_id'=>$detail_id,'glgroup_id'=>$data['GlaccountDetail']['glgroup_id']));
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
			if($ok) $ok=$this->Glaccount->save(array('id'=>$account_id,'glaccountDetail_id'=>$detail_id,'glgroup_id'=>$data['GlaccountDetail']['glgroup_id']));
		}//endif
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/**
	 * post method
	 * @param $data
	 * 		debit => array with accountid=>value
	 * 		credit => array with accountid=>value
	 * 		Glnote => text optional notes
	 * 		Glcheck => number optional check number
	 * 		Glentry => created_id => user id (required)
	 * 		Glentry => postDate => date (optional, defaults to current date)
	 * used to post to general ledger
	 */
	public function post($data){
		//must have at least one account
		if(!isset($data['credit']) || count($data['credit'])==0 || !isset($data['debit']) || count($data['debit'])==0 ) return false;
// debug($data);exit;
		//validate created_id
		if(!isset($data['Glentry']['created_id'])) return false;
		//round all entries to 2 decimal points (not sure why this is needed)
		foreach($data['debit'] as $i=>$debit) $data['debit'][$i]=number_format($debit,2);
		foreach($data['credit'] as $i=>$credit) $data['credit'][$i]=number_format($credit,2);
		//total debits and credits
		$dtotal=$ctotal=0.00;
		foreach($data['debit'] as $debit) $dtotal+=$debit;
		foreach($data['credit'] as $credit) $ctotal+=$credit;
		if(number_format($dtotal,2)!=number_format($ctotal,2)) return false;//debits must equal credits
		if($dtotal==0) return false;//can't be 0
		//if post date not set use current
		if(!isset($data['Glentry']['postDate'])) $data['Glentry']['postDate']=date('Y-m-d');
		//get models
		$this->Glentry=ClassRegistry::init('Glentry');
		$this->Glnote=ClassRegistry::init('Glnote');
		$this->Glcheck=ClassRegistry::init('Glcheck');
		$this->Glaccount=ClassRegistry::init('Glaccount');
		$this->GlaccountDetail=ClassRegistry::init('GlaccountDetail');
		$ok=true;
		$dataSource=$this->Glaccount->getDataSource();
		//start transaction
		$dataSource->begin();
		##notes
		$data['Glentry']['glnote_id']=0;
		if(!empty($data['Glnote']['text'])) {
			//save notes
			$this->Glnote->create();
			if($ok) $ok=$this->Glnote->save($data);
			if($ok) $data['Glentry']['glnote_id']=$this->Glnote->getInsertId();
		}//endif
		##check
		$data['Glentry']['glcheck_id']=0;
		if(!empty($data['Glcheck']['checkNumber'])) {
			//save check
			$data['Glcheck']['amount']=$dtotal;
			if($ok) $ok=$this->Glcheck->save($data);
			if($ok) $data['Glentry']['glcheck_id']=$this->Glcheck->getInsertId();
		}//endif
		##debits
		foreach($data['debit'] as $account=>$debit) {
			//loop for all debits
			$this->Glentry->create();
			$data['Glentry']['glaccount_id']=$account;
			$data['Glentry']['debit']=$debit;
			//verify account
			###todo
			if($ok) $ok=$this->Glentry->save($data);
		}//end foreach debit
		##credits
		$data['Glentry']['debit']=0;
		foreach($data['credit'] as $account=>$credit) {
			//loop for all credits
			$this->Glentry->create();
			$data['Glentry']['glaccount_id']=$account;
			$data['Glentry']['credit']=$credit;
			//verify account
			###todo
			if($ok) $ok=$this->Glentry->save($data);
		}//end foreach debit
//$ok=true;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		if($ok) return true;
		else return false;
		
	}
	
	/**
	 * saveSlot method
	 * @param $slot
	 * @param $glAccount_id
	 * @returns t/f
	 */
	public function saveSlot($slot,$glAccount_id) {
		//validate
		$this->Glaccount=ClassRegistry::init('Glaccount');
		$this->Glslot=ClassRegistry::init('Glslot');
		$ok=true;
		if($glAccount_id>0) {
			//ignore (none)
			$this->Glaccount->id=$glAccount_id;
			if(!$this->Glaccount->exists()) $ok= false;
		}//endif 
		$dataSource=$this->Glaccount->getDataSource();
		//start transaction
		$dataSource->begin();
		//check for existing setting
		$oldSlot=$this->Glslot->find('first',array('conditions'=>array('Glslot.slot'=>$slot,'Glslot.active')));
		if($oldSlot){
			//slot is set so check if it has changed
			if($oldSlot['Glslot']['glaccount_id']==$glAccount_id) {
				//has not changed so leave alone
				$glAccount_id=0;
			} else {
				//remove old setting
				$oldSlot['Glslot']['removed_id']=$this->Auth->user('id');
				$oldSlot['Glslot']['removed']=date('Y-m_d h:m:s');
				$oldSlot['Glslot']['active']=false;
				if($ok)$ok=$this->Glslot->save($oldSlot);
			}//endif
		}//endif
		if($glAccount_id>0) {
			//set new slot
			$newSlot=array('created_id'=>$this->Auth->user('id'),'slot'=>$slot,'glaccount_id'=>$glAccount_id,'active'=>true);
			if(substr($slot,-5)=='debit') $newSlot['debit']=true;
			else $newSlot['credit']=true;
			if($ok)$this->Glslot->create();
			if($ok)$ok=$this->Glslot->save($newSlot);
		}//endif
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end saveSlot
	
	/**
	 * getSlot method
	 * @param $slot name of slot to fetch
	 * @return GL account for slot or null
	 */
	public function getSlot($slot) {
		//setup
		$this->Glslot=ClassRegistry::init('Glslot');
		return $this->Glslot->field('glaccount_id',array('slot'=>$slot,'active'));
	}
}