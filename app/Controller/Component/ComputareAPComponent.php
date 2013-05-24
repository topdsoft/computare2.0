<?php
/**
 * ComputareAPComponent.php
 * 
 * Part of computare accounting system used to edit accounts payable
 * */

App::uses('Component','Controller');
class ComputareAPComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie','ComputareIC','ComputareGL');
	
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
				//do GL posting
				$credit=0;
				$debit=array();
				if($data['PurchaseOrder']['shipping']>0) {
					//post shipping
					$shippingAcct_id=$this->ComputareGL->getSlot('recShipdebit');
					if(!$shippingAcct_id) {
						//slot "recShipdebit" must be set
						$ok=false;
						$dataSource->rollback();
						throw new NotFoundException(__('The debit slot is not set for Shipping in Recieve Inventory group.'));
					}//endif
					$credit+=$data['PurchaseOrder']['shipping'];
					$debit[$shippingAcct_id]=$data['PurchaseOrder']['shipping'];
					unset($shippingAcct_id);
				}//endif
				if($data['PurchaseOrder']['tax']>0) {
					//post tax paid
					$taxAcct_id=$this->ComputareGL->getSlot('recTaxdebit');
					if(!$taxAcct_id) {
						//slot "recTaxdebit" must be set
						$ok=false;
						$dataSource->rollback();
						throw new NotFoundException(__('The debit slot is not set for Tax paid in Recieve Inventory group.'));
					}//endif
					$credit+=$data['PurchaseOrder']['tax'];
					$debit[$taxAcct_id]=$data['PurchaseOrder']['tax'];
					unset($taxAcct_id);
				}//endif
				if($credit>0){
					//find what credit account to use
					if($this->PurchaseOrder->field('onAccount',array('PurchaseOrder.id'=>$data['PurchaseOrder']['id']))) {
						//on account so use an accounts payable or vendor credit account
						$vendor_id=$this->PurchaseOrder->field('vendor_id',array('PurchaseOrder.id'=>$data['PurchaseOrder']['id']));
						$creditAcct_id=ClassRegistry::init('VendorDetail')->field('glAccount_id',array('vendor_id'=>$vendor_id,'active'));
						if(!$creditAcct_id) {
							//use default account
							$creditAcct_id=$this->ComputareGL->getSlot('recAPcredit');
							if(!$creditAcct_id) {
								//slot must be set
								$ok=false;
								$dataSource->rollback();
								throw new NotFoundException(__('The credit slot is not set for Accounts Payable in Recieve Inventory group.'));
							}//endif
						}//endif
					} else {
						//not on account so use cash account
						$creditAcct_id=$this->ComputareGL->getSlot('payCashcredit');
						if(!$creditAcct_id) {
							//slot must be set
							$ok=false;
							$dataSource->rollback();
							throw new NotFoundException(__('The credit slot is not set for Cash in Pay Invoice group.'));
						}//endif
					}//endif
					$credit=array($creditAcct_id=>$credit);
					unset($creditAcct_id);
					//post to GL
					if($ok) $ok=$this->ComputareGL->post(array(
						'Glentry'=>array('created_id'=>$this->Auth->user('id')),
						'debit'=>$debit,
						'credit'=>$credit,
					));
					unset($debit);
					unset($credit);
					if(isset($vendor_id)) {
						//create invoice
						$this->Invoice=ClassRegistry::init('Invoice');
						if($ok) $this->Invoice->create();
						if($ok) $ok=$this->Invoice->save(array(
							'number'=>$data['PurchaseOrder']['number'],
							'vendor_id'=>$vendor_id,
							'purchaseOrder_id'=>$data['PurchaseOrder']['id'],
							'created_id'=>$this->Auth->user('id'),
							'status'=>'O'
						));
						if($ok)$invoice_id=$this->Invoice->getInsertId();
						if($ok) {
							//sum total for invoice
							$sum=$data['PurchaseOrder']['tax']+$data['PurchaseOrder']['shipping'];
							$POsum=$this->PurchaseOrder->PurchaseOrderDetail->find('all',array(
								'conditions'=>array('PurchaseOrderDetail.purchaseOrder_id'=>$data['PurchaseOrder']['id'],'PurchaseOrderDetail.active'),
								'fields'=>array('sum(PurchaseOrderDetail.rec * PurchaseOrderDetail.cost) as sum')
							));
							$sum+=$POsum[0][0]['sum'];
							if($ok)$this->Invoice->InvoiceDetail->create();
							if($ok)$ok=$this->Invoice->InvoiceDetail->save(array(
								'invoice_id'=>$invoice_id,
								'created_id'=>$this->Auth->user('id'),
								'active'=>true,
								'text'=>"Vendor Invoice: ".$data['PurchaseOrder']['number'],
								'amount'=>$sum,
							));
							unset($sum);
							unset($POsum);
						}//endif
// debug($sum);exit;
					}//endif
				}//endif
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
	
	/** method receivePO
	 * @param array $data
		* $data['PurchaseOrder']['shipping']  (optional)
		* $data['PurchaseOrder']['tax']  (optional)
		* $data['PurchaseOrderDetail']=>array
			* ['id']  (required)
			* ['recQty']  (required) Amount to receive this time
	* @return t/f
	*/
	public function receivePO($data) {
		//recieve items on po
		$this->PurchaseOrder=ClassRegistry::init('PurchaseOrder');
		$ok=true;
		$dataSource=$this->PurchaseOrder->getDataSource();
		//start transaction
		$dataSource->begin();
		foreach($data['PurchaseOrderDetail'] as $detail) {
			//loop for all items on po
			if($detail['recQty']) {
				//amount has been entered
/*  move to ComputareICComponent
				$newDetail=$oldDetail=$this->PurchaseOrder->PurchaseOrderDetail->find('first',array('recursive'=>-1,'conditions'=>array('PurchaseOrderDetail.id'=>$detail['PurchaseOrderDetail']['id'])));
				if($oldDetail['PurchaseOrderDetail']['rec']>0) {
					//allready has some rec on this line
					unset($newDetail['PurchaseOrderDetail']['qty']);
					unset($newDetail['PurchaseOrderDetail']['cost']);
				} else {
					//line has not yet had any qty received so remove old detail
					$oldDetail['PurchaseOrderDetail']['active']=false;
					$oldDetail['PurchaseOrderDetail']['removed']=date('Y-m-d h:m:s');
					$oldDetail['PurchaseOrderDetail']['removed_id']=$this->Auth->user('id');
					if($ok)$ok=$this->PurchaseOrder->PurchaseOrderDetail->save($oldDetail);
					unset($oldDetail);
				}//endif
				//create new detail
				$newDetail['PurchaseOrderDetail']['rec']=$detail['recQty'];
				unset($newDetail['PurchaseOrderDetail']['id']);
				if($ok)$this->PurchaseOrder->PurchaseOrderDetail->create();
				if($ok)$ok=$this->PurchaseOrder->PurchaseOrderDetail->save($newDetail);
				unset($newDetail);//*/
				$saveData=array(
					'item_id'=>$this->PurchaseOrder->PurchaseOrderDetail->field('item_id',array('PurchaseOrderDetail.id'=>$detail['id'])),
					'location_id'=>$data['PurchaseOrder']['location_id'],
					'purchaseOrder_id'=>$data['PurchaseOrder']['id'],
					'qty'=>$detail['recQty'],
					'receiptType_id'=>$data['PurchaseOrder']['receiptType_id'],
				);
				if(isset($detail['serialNumbers'])) $saveData['serialNumbers']=$detail['serialNumbers'];
				if($ok) $ok=$this->ComputareIC->receive($saveData);
			}//endif
		}//endforeach
		//save tax and shipping
#TODO
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end function receivePO
}