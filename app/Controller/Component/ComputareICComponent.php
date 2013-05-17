<?php
/**
 * ComputareICComponent.php
 * 
 * Part of computare accounting system used to edit items
 * */

App::uses('Component','Controller');
class ComputareICComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie','ComputareGL');
	
	/**
	 * saveItem method
	 * @param $data
	 * used to save item data
	 */
	public function saveItem($data){
		//save item data
		$this->Item=ClassRegistry::init('Item');
		$this->ItemDetail=ClassRegistry::init('ItemDetail');
		$ok=true;
		$dataSource=$this->Item->getDataSource();
		//start transaction
		$dataSource->begin();
// debug($data['Item']['id']);exit;
		if(isset($data['Item']['id'])) {
			//editing existing item
		} else {
			//creating new item
			if($ok) $ok=$this->Item->save($data['Item']);
			if($ok) $data['Item']['id']=$this->Item->getInsertId();
		}//endif
		$data['ItemDetail']['category_id']=$data['Item']['category_id'];
		$data['ItemDetail']['item_id']=$data['Item']['id'];
		$data['ItemDetail']['created_id']=$this->Auth->User('id');
		//save itemDetails
		if($ok) $ok=$this->ItemDetail->save($data['ItemDetail']);
		//update itemDetail_id
		$data['Item']['itemDetail_id']=$this->ItemDetail->getInsertId();
		//save just Item and ItemGroup data (itemDetail allready saved)
		unset($data['ItemDetail']);
// 		if($ok) $ok=$this->Item->save($data['Item']);
		if($ok) $ok=$this->Item->save($data);
// debug($data);exit;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end function saveItem

	/**
	 * saveLocation method
	 * @param $data
	 * used to save location data
	 */
	public function saveLocation($data){
		//save location data
		$this->Location=ClassRegistry::init('Location');
		$this->LocationDetail=ClassRegistry::init('LocationDetail');
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//start transaction
		$dataSource->begin();
// debug($data);exit;
		if(isset($data['Location']['id'])) {
			//editing existing Location
		} else {
			//creating new Location
			if($ok) $ok=$this->Location->save($data['Location']);
			if($ok) $data['Location']['id']=$this->Location->getInsertId();
		}//endif
		$data['LocationDetail']['location_id']=$data['Location']['id'];
		$data['LocationDetail']['created_id']=$this->Auth->User('id');
		$data['LocationDetail']['parent_id']=$data['Location']['parent_id'];
		//save locationDetails
		if($ok) $ok=$this->LocationDetail->save($data['LocationDetail']);
		//update locationDetail_id
		$data['Location']['locationDetail_id']=$this->LocationDetail->getInsertId();
		if($ok) $ok=$this->Location->save($data['Location']);
// debug($data);exit;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end function saveLocation
	
	/**
	 * saveItemGroup
	 * @param array $data
	 * @return t/f
	 */
	public function saveItemGroup($data){
		//save item group data
		$this->ItemGroup=ClassRegistry::init('ItemGroup');
		$ok=true;
		$dataSource=$this->ItemGroup->getDataSource();
		//start transaction
		$dataSource->begin();
// debug($data); exit;
		$data['ItemGroup']['created_id']=$this->Auth->User('id');
		if($ok) $ok=$this->ItemGroup->save($data['ItemGroup']);
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/**
	 * saveItemCategory method
	 * @param array $data
	 * @return t/f
	 */
	public function saveItemCategory($data){
		//save item category
		$this->ItemCategory=ClassRegistry::init('ItemCategory');
		$ok=true;
		$dataSource=$this->ItemCategory->getDataSource();
		//start transaction
		$dataSource->begin();
// debug($data); exit;
		$data['ItemCategory']['created_id']=$this->Auth->User('id');
		if($ok) $ok=$this->ItemCategory->save($data['ItemCategory']);
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/**
	 * receive method
	 * @param array $data
		* $item_id
		* $location_id
		* $purchaseOrder_id
		* $qty
		* $serialNumbers (optional) array
	 * @return t/f
	 */
	public function receive($data) {
		//receive inventory
		$this->Location=ClassRegistry::init('Location');
		$this->Item=ClassRegistry::init('Item');
		$this->ItemCosts=ClassRegistry::init('ItemCosts');
		$this->Receipts=ClassRegistry::init('Receipts');
		$this->PurchaseOrder=ClassRegistry::init('PurchaseOrder');
		$this->VendorDetail=ClassRegistry::init('VendorDetail');
		$this->ReceiptType=ClassRegistry::init('ReceiptType');
		//get purchase order
		$purchaseOrder=$this->PurchaseOrder->read(null,$data['purchaseOrder_id']);
// debug($purchaseOrder);
		if(!$purchaseOrder) return false;
		$item=$this->Item->read(null,$data['item_id']);
		if(!$item) return false;
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//start transaction
		$dataSource->begin();
		//create entry in receipts table
		$data['Receipts']['created_id']=$this->Auth->User('id');
		$data['Receipts']['item_id']=$data['item_id'];
		$data['Receipts']['purchaseOrder_id']=$data['purchaseOrder_id'];
		$data['Receipts']['vendor_id']=$purchaseOrder['PurchaseOrder']['vendor_id'];
		$data['Receipts']['qty']=$data['qty'];
		if($ok) $ok=$this->Receipts->save($data['Receipts']);
		//create entry in itemTransactions table
		$data['ItemTransaction']['type']='R';
		$data['ItemTransaction']['qty']=$data['qty'];
		$data['ItemTransaction']['created_id']=$this->Auth->User('id');
		$data['ItemTransaction']['receipt_id']=$this->Receipts->getInsertId();
		$data['ItemTransaction']['item_id']=$data['item_id'];
		$data['ItemTransaction']['location_id']=$data['location_id'];
		if($ok) $ok=$this->Item->ItemTransaction->save($data['ItemTransaction']);
		//create entry in items_locations table
		$il=$this->Item->ItemsLocation->find('first',array('conditions'=>array('item_id'=>$data['item_id'],'location_id'=>$data['location_id'])));
// debug($il);exit;
		if($il) {
			//item_location exists
			$data['ItemsLocation']['id']=$item_location_id=$il['ItemsLocation']['id'];
			$data['ItemsLocation']['item_id']=$il['ItemsLocation']['item_id'];
			$data['ItemsLocation']['location_id']=$il['ItemsLocation']['location_id'];
			$data['ItemsLocation']['qty']=$il['ItemsLocation']['qty']+$data['qty'];
		} else {
			//item_location does not exist
			$data['ItemsLocation']['created_id']=$this->Auth->User('id');
			$data['ItemsLocation']['item_id']=$data['item_id'];
			$data['ItemsLocation']['location_id']=$data['location_id'];
			$data['ItemsLocation']['qty']=$data['qty'];
		}//endif
		if($ok) $ok=$this->Item->ItemsLocation->save($data['ItemsLocation']);
		if($ok && !isset($item_location_id)) $item_location_id=$this->Item->ItemsLocation->getInsertId();
		//update purchase order details
		$poDetail=$this->PurchaseOrder->PurchaseOrderDetail->find('first',array('conditions'=>array('PurchaseOrderDetail.active','purchaseOrder_id'=>$data['purchaseOrder_id'], 'item_id'=>$data['item_id'])));
		if(!$poDetail) {
			//item not found on this po
			if($purchaseOrder['PurchaseOrder']['allowOpen']) {
				//po is ok for adding new items
				$data['PurchaseOrderDetails']['created_id']=$this->Auth->User('id');
				$data['PurchaseOrderDetails']['purchaseOrder_id']=$data['purchaseOrder_id'];
				$data['PurchaseOrderDetails']['item_id']=$data['item_id'];
				$data['PurchaseOrderDetails']['rec']=$data['qty'];
				//??cost
				if($data['cost']) $data['PurchaseOrderDetails']['cost']=$data['cost'];
				else $data['PurchaseOrderDetails']['cost']=0;
			} else $ok=false;
		} else {
			//item found on po
			$data['PurchaseOrderDetails']['id']=$poDetail['PurchaseOrderDetail']['id'];
			$data['PurchaseOrderDetails']['rec']=$poDetail['PurchaseOrderDetail']['rec']+$data['qty'];
		}//endif
		if($ok) $ok=$this->PurchaseOrder->PurchaseOrderDetail->save($data['PurchaseOrderDetails']);
		//insert into itemCosts table
		$data['ItemCost']['created_id']=$this->Auth->User('id');
		$data['ItemCost']['item_id']=$data['item_id'];
		$data['ItemCost']['vendor_id']=$purchaseOrder['PurchaseOrder']['vendor_id'];
		if($poDetail) {
			//use cost from PO
			$data['ItemCost']['cost']=$poDetail['PurchaseOrderDetail']['cost'];
		} else {
			//use entered cost
			if($data['cost']) $data['ItemCost']['cost']=$data['cost'];
			else $data['ItemCost']['cost']=0;
		}//endif
		$data['ItemCost']['qty']=$data['qty'];
		$data['ItemCost']['remain']=$data['qty'];
		if($ok) $ok=$this->Item->ItemCost->save($data['ItemCost']);
		//GL posting
		if($ok && $data['ItemCost']['cost']>0) {
			//only post to GL if there is a cost
			$vendorGL_id=$this->VendorDetail->field('glAccount_id',array('vendor_id'=>$data['Receipts']['vendor_id'],'active'));
			if(!$vendorGL_id) {
				//vendor has no specific gl account set so use default
				$vendorGL_id=$this->ComputareGL->getSlot('recAPcredit');
				if(!$vendorGL_id) {
					//slot "recAPcredit" must be set
					$ok=false;
					$dataSource->rollback();
					throw new NotFoundException(__('The credit slot is not set for Accounts Payable in Recieve Inventory group.'));
// 					$this->Session->setFlash(__('The credit slot is not set forAccounts Payable in Recieve Inventory group.'));
				}//endif
			}//endif
			$assetGL_id=$this->ReceiptType->field('glAccount_id',array('ReceiptType.id'=>$data['receiptType_id']));
			if(!$assetGL_id) {
				//receipt tpe has no assigned GL account so use default
				$assetGL_id=$this->ComputareGL->getSlot('recInvdebit');
				if(!$assetGL_id) {
					//slot "recInvdebit" must be set
					$dataSource->rollback();
					throw new NotFoundException(__('The debit slot is not set for Inventory Assets in Recieve Inventory group.'));
				}//endif
			}//endif
			//do GL posting
// debug($ok==true);
			$ok=$this->ComputareGL->post(array(
				'Glentry'=>array('created_id'=>$this->Auth->user('id')),
				'debit'=>array($assetGL_id=>$data['ItemCost']['cost']*$data['ItemCost']['qty']),
				'credit'=>array($vendorGL_id=>$data['ItemCost']['cost']*$data['ItemCost']['qty']),
			));
// debug($assetGL_id);debug($ok);exit;
		}//endif
		//serialNumbers
		if($item['Item']['serialized']) {
			//save serial number data
			$data['ItemSerialNumber']['number']=$data['number'];
			$data['ItemSerialNumber']['created_id']=$this->Auth->User('id');
			$data['ItemSerialNumber']['item_id']=$data['item_id'];
			$data['ItemSerialNumber']['item_location_id']=$item_location_id;
			if($ok) $ok=$this->Item->ItemSerialNumber->save($data['ItemSerialNumber']);
		}//endif
// debug($data);exit;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function receive
	
	/**
	 * transfer method
	 * @param array $data
		* 'item_location_id'
		* 'qty'
		* 'location_id'
		* 'serialNumbers'=>array of itemSerialNumber.id to be moved
	 */
	public function transfer($data) {
		//transfer inventory
		$this->Location=ClassRegistry::init('Location');
		$this->Item=ClassRegistry::init('Item');
		//validate item_location_id
		$il=$this->Item->ItemsLocation->read(null,$data['item_location_id']);
		if(!$il) return false;
		//check for serialized item
		if(isset($data['serialNumbers'])) {
			//set qty
			$data['qty']=count($data['serialNumbers']);
		}//endif
		//validate qty
		if($data['qty']<1 || $data['qty']>$il['ItemsLocation']['qty']) return false;
		//validate location_id
		$newLocation=$this->Location->read(null,$data['location_id']);
		if(!$newLocation) return false;
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//start transaction
		$dataSource->begin();
		//itemTransactions (from)
		$trans['created_id']=$this->Auth->User('id');
		$trans['item_id']=$il['ItemsLocation']['item_id'];
		$trans['location_id']=$il['ItemsLocation']['location_id'];
		$trans['qty']=$data['qty']*-1;
		$trans['type']='T';
		if($ok) $ok=$this->Item->ItemTransaction->save($trans);
		//itemTransactions (to)
		$trans['location_id']=$data['location_id'];
		$trans['qty']=$data['qty'];
// 		unset($trans['id']);
		if($ok) $this->Item->ItemTransaction->create();
		if($ok) $ok=$this->Item->ItemTransaction->save($trans);
		unset($trans);
		//items_locations (from)
		if($data['qty']==$il['ItemsLocation']['qty']) {
			//moving all qty from location
// debug($ok);exit;
			if($ok) $ok=$this->Item->ItemsLocation->delete($data['item_location_id']);
		} else {
			//qty remains at loaction
			$il['ItemsLocation']['qty']-=$data['qty'];
			if($ok) $ok=$this->Item->ItemsLocation->save($il);
		}//endif
		//items_locations (to)
		$to=$this->Item->ItemsLocation->find('first',array('conditions'=>array('item_id'=>$il['ItemsLocation']['item_id'],'location_id'=>$data['location_id'])));
		if($to) {
			//item already has qty at this location
			$to['ItemsLocation']['qty']+=$data['qty'];
			if($ok) $ok=$this->Item->ItemsLocation->save($to);
			$newIL_id=$to['ItemsLocation']['id'];
// debug($to);exit;
		} else {
			//item new to this location
			if($ok) $this->Item->ItemsLocation->create();
			if($ok) $ok=$this->Item->ItemsLocation->save(array(
				'item_id'=>$il['ItemsLocation']['item_id'],
				'location_id'=>$data['location_id'],
				'qty'=>$data['qty'],
				'created_id'=>$this->Auth->User('id')
			));
			if($ok) $newIL_id=$this->Item->ItemsLocation->getInsertId();
		}//endif
		//itemSerialNumbers
		if(isset($data['serialNumbers'])) {
			//item is serialized
			foreach($data['serialNumbers'] as $num) {
				//loop for all serial numbers and update to the new location
				if($ok) $ok=$this->Item->ItemSerialNumber->save(array('id'=>$num,'item_location_id'=>$newIL_id));
			}//end foreach
		}//endif
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function transfer
	
}