<?php
/**
 * ComputareCustomerComponent.php
 * 
 * Part of computare accounting system used to support customers
 * */

App::uses('Component','Controller');
class ComputareCustomerComponent extends Component {
	/**
	 * save method
	 * @param data
	 * 
	 */
	public function save($data) {
		//get models
		$this->Customer=ClassRegistry::init('Customer');
		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
		$this->Address=ClassRegistry::init('Address');
		$ok=true;
		$dataSource=$this->Customer->getDataSource();
		//start transaction
		$dataSource->begin();
		//validation
		if(!isset($data['CustomerDetail']['companyName']) || $data['CustomerDetail']['companyName']=='') {
			if(!isset($data['CustomerDetail']['firstName']) || $data['CustomerDetail']['firstName']=='') {
				if(!isset($data['CustomerDetail']['lastName']) || $data['CustomerDetail']['lastName']=='') {
					//must enter something for a firstName,lastName or companyName
					$ok=false;
				}//endif
			}//endif
		}//endif
		//first check if new customer or saving changes to existing
		if($data['Customer']['id']) {
			//existing customer
			$this->CustomerDetail->create();
			if($ok)$ok=$this->CustomerDetail->save($data['CustomerDetail']);
			$customerDetail_id=$this->CustomerDetail->getLastInsertId();
			//link new details back to customer
			if($ok) $ok=$this->Customer->save(array('id'=>$data['CustomerDetail']['customer_id'],'customerDetail_id'=>$customerDetail_id));
		} else {
			//new customer
			$this->Customer->create();
			if($ok)$ok=$this->Customer->save(array('active'=>true,'created_id'=>$data['CustomerDetail']['created_id'],'customerDetail_id'=>0));
			$customer_id=$this->Customer->getInsertId();
			//save customer details
			$data['CustomerDetail']['customer_id']=$customer_id;
			$this->CustomerDetail->create();
			if($ok) $ok=$this->CustomerDetail->save($data['CustomerDetail']);
			$customerDetail_id=$this->CustomerDetail->getLastInsertId();
			//link new details back to customer
			if($ok) $ok=$this->Customer->save(array('id'=>$customer_id,'customerDetail_id'=>$customerDetail_id));
		}//endif
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end function save
	
	/**
	 * delete method
	 * @param string $id  //ID of customer to be deleted
	 * @param string $uid  //id of current user
	 */
	public function delete($id, $uid) {
		//get models
		$this->Customer=ClassRegistry::init('Customer');
		$customer=$this->Customer->read(null,$id);
		if($customer) {
			//found ok
			if($customer['Customer']['active']) {
				//customer is active
				$customer['Customer']['active']=false;
				$customer['Customer']['deleted_id']=$uid;
				unset($customer['Customer']['modified']);
				unset($customer['CustomerDetail']);
//debug($customer);exit;
				return $this->Customer->save($customer);
			}//endif
		}//endif
		return false;
	}
}