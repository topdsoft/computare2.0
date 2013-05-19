<?php
/**
 * ComputareAPComponent.php
 * 
 * Part of computare accounting system used to edit accounts payable
 * */

App::uses('Component','Controller');
class ComputareAPComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie');
	
	/**
	 * method saveVendor
	 * @param array $data
		* $data['Vendor']['id'] (optional for editing existing vendor)
		* $data['VendorDetail']['name'] (required)
		* $data['VendorDetail']['glAccount_id'] (optional)
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
		} else {
			//existing vendor
			$vendorDetail_id=$this->Vendor->field('vendorDetail_id',array('Vendor.id'=>$data['Vendor']['id']));
			if($vendorDetail_id) {
				//found existing vendor ok
				$oldVendorDetail=$this->Vendor->VendorDetail->find('first',array('conditions'=>array('VendorDetail.id'=>$vendorDetail_id),'recursive'=>-1));
				$oldVendorDetail['VendorDetail']['active']=false;
				$oldVendorDetail['VendorDetail']['removed']=date('Y-m-d h:m:s');
				$oldVendorDetail['VendorDetail']['removed_id']=$this->Auth->user('id');
				if($ok) $ok=$this->Vendor->VendorDetail->save($oldVendorDetail);
				unset($oldVendorDetail);
			} else $ok=false;
		}//endif
		$data['VendorDetail']['vendor_id']=$data['Vendor']['id'];
		$data['VendorDetail']['created_id']=$this->Auth->User('id');
		$data['VendorDetail']['active']=true;
		if($ok) $this->Vendor->VendorDetail->create();
		if($ok) $ok=$this->Vendor->VendorDetail->save($data['VendorDetail']);
		//save new vendorDetail_id
		if($ok) $data['Vendor']['vendorDetail_id']=$this->Vendor->VendorDetail->getInsertId();
		if($ok) $ok=$this->Vendor->save($data['Vendor']);
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function saveVendor
	
	/**
	 * method savePO
	 * @param array data
		* For new PO pass:
			* $data['PurchaseOrder']['vendor_id']
			* $data['PurchaseOrder']['status']=>'O'
			* $data['PurchaseOrder']['allowOpen']
		*  To void a PO pass:
			* $data['PurchaseOrder']['id']
			* $data['PurchaseOrder']['status']=>'V'
		*  To close a PO pass:
			* $data['PurchaseOrder']['id']
			* $data['PurchaseOrder']['status']=>'C'
			* $data['PurchaseOrder']['shipping']
			* $data['PurchaseOrder']['tax']
		* To add a PO line pass:
			* $data['PurchaseOrder']['id']
			* $data['PurchaseOrderDetail']['item_id']
			* $data['PurchaseOrderDetail']['qty']
			* $data['PurchaseOrderDetail']['cost']
		* To remove a PO line pass: $data['removeLine']=>purchaseOrderDetails.id
	 * @returns t/f
	 */
	public function savePO($data) {
		//save PO data
		$this->PurchaseOrder=ClassRegistry::init('PurchaseOrder');
		$ok=true;
		$dataSource=$this->PurchaseOrder->getDataSource();
		//start transaction
		$dataSource->begin();
		if(!isset($data['removeLine']) && !isset($data['PurchaseOrderDetail'])) {
			//adding or removing a line does not affect purchaseOrders table
			if(!isset($data['PurchaseOrder']['id'])) {
				//new PO
				$data['PurchaseOrder']['created_id']=$this->Auth->User('id');
				if($ok) $this->PurchaseOrder->create();
			}//endif
			if($data['PurchaseOrder']['status']=='V') {
				//void
				$rec=$this->PurchaseOrder->field('rec',array('PurchaseOrder.id'=>$data['PurchaseOrder']['id']));
				if($rec>0) $ok=false;//can't void PO with qry received
				unset($rec);
				$data['PurchaseOrder']['voided']=date('Y-m-d h:m:s');
				$data['PurchaseOrder']['voided_id']=$this->Auth->User('id');
			} elseif ($data['PurchaseOrder']['status']=='C') {
				//close
				$data['PurchaseOrder']['closed']=date('Y-m-d h:m:s');
				$data['PurchaseOrder']['closed_id']=$this->Auth->User('id');
			}//endif
			if($ok) $ok=$this->PurchaseOrder->save($data['PurchaseOrder']);
		}//endif
		//check for and save new PO line
		if(isset($data['PurchaseOrderDetail']['item_id']) && isset($data['PurchaseOrderDetail']['qty']) && isset($data['PurchaseOrderDetail']['cost']) ){
			//insert new po line
			$data['PurchaseOrderDetail']['purchaseOrder_id']=$data['PurchaseOrder']['id'];
			$data['PurchaseOrderDetail']['created_id']=$this->Auth->User('id');
			$data['PurchaseOrderDetail']['active']=true;
			if($ok) $this->PurchaseOrder->PurchaseOrderDetail->create();
			if($ok) $ok=$this->PurchaseOrder->PurchaseOrderDetail->save($data['PurchaseOrderDetail']);
		}//endif
		if(isset($data['removeLine'])) {
			//remove a line
			$data['PurchaseOrderDetail']['id']=$data['removeLine'];
			$data['PurchaseOrderDetail']['removed_id']=$this->Auth->User('id');
			$data['PurchaseOrderDetail']['removed']=date('Y-m-d h:m:s');
			$data['PurchaseOrderDetail']['active']=false;
			if($ok) $ok=$this->PurchaseOrder->PurchaseOrderDetail->save($data['PurchaseOrderDetail']);
		}//endif
// debug($data);exit;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
}