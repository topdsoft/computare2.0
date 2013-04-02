<?php
/**
 * ComputareARComponent.php
 * 
 * Part of computare accounting system used to edit accounts receivable
 * */

App::uses('Component','Controller');
class ComputareARComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie');
	
	/**
	 * method saveVendor
	 * @param array $data
	 * @returns t/f
	 */
	public function saveVendor($data) {
		//save vendor data
		$this->Vendor=ClassRegistry::init('Vendor');
		$ok=true;
		$dataSource=$this->Vendor->getDataSource();
		//start transaction
		$dataSource->begin();
		if(!isset($data['Vendor']['id'])) {
			//new vendor
			if($ok) $this->Vendor->create();
			if($ok) $ok=$this->Vendor->save(array('created_id'=>$this->Auth->User('id'),'active'=>true));
			if($ok) $data['Vendor']['id']=$this->Vendor->getInsertId();
		}//endif
		$data['VendorDetail']['vendor_id']=$data['Vendor']['id'];
		$data['VendorDetail']['created_id']=$this->Auth->User('id');
		if($ok) $this->Vendor->VendorDetail->create();
		if($ok) $ok=$this->Vendor->VendorDetail->save($data['VendorDetail']);
		//save new vendorDetail_id
		if($ok) $data['Vendor']['vendorDetail_id']=$this->Vendor->VendorDetail->getInsertId();
		if($ok) $ok=$this->Vendor->save($data['Vendor']);
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function saveVendor
}