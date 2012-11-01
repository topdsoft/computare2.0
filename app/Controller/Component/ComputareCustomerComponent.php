<?php
/**
 * ComputareCustomerComponent.php
 * 
 * Part of computare accounting system used to support customers
 * */

App::uses('component','controller');
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
		//first check if new customer or saving changes to existing
		if($data['Customer']['id']) {
//debug($data);exit;
			//existing customer
			$this->CustomerDetail->create();
			$this->CustomerDetail->save($data['CustomerDetail']);
			$customerDetail_id=$this->CustomerDetail->getLastInsertId();
			//link new details back to customer
			$this->Customer->save(array('id'=>$data['CustomerDetail']['customer_id'],'customerDetail_id'=>$customerDetail_id));
		} else {
			//new customer
			$this->Customer->create();
			$this->Customer->save(array('id'=>null,'active'=>true,'created_id'=>$data['CustomerDetail']['created_id']));
			$customer_id=$this->Customer->getLastInsertId();
			//save customer details
			$data['CustomerDetail']['customer_id']=$customer_id;
			$this->CustomerDetail->create();
			$this->CustomerDetail->save($data['CustomerDetail']);
			$customerDetail_id=$this->CustomerDetail->getLastInsertId();
			//link new details back to customer
			$this->Customer->save(array('id'=>$customer_id,'customerDetail_id'=>$customerDetail_id));
		}//endif
		return true;
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