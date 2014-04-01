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
		* 'removeImage'=>array(image_id=>t/f) if set to t image will be removed
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
			$data['Item']['active']=true;
			if($ok) $ok=$this->Item->save($data['Item']);
			if($ok) $data['Item']['id']=$this->Item->getInsertId();
		}//endif
		if(isset($data['Item']['category_id']))$data['ItemDetail']['category_id']=$data['Item']['category_id'];
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
		//check for removed images
		if($ok && isset($data['removeImage'])) {
			//parse list of removed images
			foreach($data['removeImage'] as $image_id=>$remove) {
				//loop for all images
				if($ok && $remove) {
					//find images_items id
					$ii_id=$this->Item->ImagesItem->field('id',array('item_id'=>$data['Item']['id'],'image_id'=>$image_id));
					if($ii_id) $ok=$this->Item->ImagesItem->delete($ii_id);
					unset($ii_id);
				}//endif
			}//end foreach
		}//endif
// debug($data);exit;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end function saveItem

	/**
	 * saveLocation method
	 * @param $data
		* ['Location']['id'] (required for existing location)
		* ['Location']['parent_id'] (required)
		* ['LocationDetail']['name'] (required new)
	 * used to save location data
	 */
	public function saveLocation($data){
		//save location data
		$this->Location=ClassRegistry::init('Location');
		$this->LocationDetail=ClassRegistry::init('LocationDetail');
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//copy name-type data to locations table for easier lookup
		if(isset($data['LocationDetail']['name'])) $data['Location']['name']=$data['LocationDetail']['name'];
		if(isset($data['LocationDetail']['locationType_id'])) $data['Location']['locationType_id']=$data['LocationDetail']['locationType_id'];
		//start transaction
		$dataSource->begin();
		if(isset($data['Location']['id'])) {
			//editing existing Location
			$locationDetail_id=$this->Location->field('locationDetail_id',array('Location.id'=>$data['Location']['id']));
			//copy existing location detail
			$existingDetail=$this->Location->LocationDetail->find('first',array('recursive'=>0,'conditions'=>array('LocationDetail.id'=>$locationDetail_id)));
			unset($existingDetail['LocationDetail']['id']);
			if($ok) $this->Location->LocationDetail->create();
			if($ok) $ok=$this->Location->LocationDetail->save($existingDetail);
// debug($data);debug($locationDetail_id);debug($existingDetail); exit;
		} else {
			//creating new Location
			if($ok) $this->Location->create();
			if($ok) $ok=$this->Location->save($data['Location']);
			if($ok) $data['Location']['id']=$this->Location->getInsertId();
			if($data['Location']['locationType_id']) {
				//get location type info
				$locationType=$this->Location->LocationType->read(null,$data['Location']['locationType_id']);
				if($locationType['LocationType']['next_number']!=null) {
					//location type uses auto numbering
					if($data['Location']['name']==$locationType['LocationType']['default_name'].$locationType['LocationType']['next_number']) {
						//user did not modify name so increment to next auto number
						$locationType['LocationType']['next_number']++;
						if($ok) $ok=$this->Location->LocationType->save($locationType);
					}//endif
				}//endif
			}//endif
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
		* $data['item_id']
		* $data['location_id']
		* $data['purchaseOrder_id']
		* $data[qty]
		* $data[cost] (optional, if Item is already on PO that cost will be used, if not on PO this value will be used or, if not passed and not on PO 0 will be used)
		* $data['receiptType_id']
		* $data['serialNumbers'] (optional) array
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
		//check for empty cost
		if(isset($data['cost']) && $data['cost']=='') unset($data['cost']);
		//get purchase order
		$purchaseOrder=$this->PurchaseOrder->read(null,$data['purchaseOrder_id']);
// debug($data);exit;
		if(!$purchaseOrder) return false;
		$item=$this->Item->read(null,$data['item_id']);
		if(!$item) return false;
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//start transaction
		$dataSource->begin();
		//check for lock
		if($this->checkLock($data['location_id'])) $ok=false;
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
		if($ok) $this->Item->ItemTransaction->create();
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
			if($ok) $this->Item->ItemsLocation->create();
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
				$data['PurchaseOrderDetails']['active']=true;
				$data['PurchaseOrderDetails']['purchaseOrder_id']=$data['purchaseOrder_id'];
				$data['PurchaseOrderDetails']['item_id']=$data['item_id'];
				$data['PurchaseOrderDetails']['rec']=$data['qty'];
				//if cost passed then use it, otherwise use 0
				if(isset($data['cost'])) $data['PurchaseOrderDetails']['cost']=$data['cost'];
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
			if(isset($data['cost'])) $data['ItemCost']['cost']=$data['cost'];
			else $data['ItemCost']['cost']=0;
		}//endif
		$data['ItemCost']['qty']=$data['qty'];
		$data['ItemCost']['remain']=$data['qty'];
		if($ok) $this->Item->ItemCost->create();
		if($ok) $ok=$this->Item->ItemCost->save($data['ItemCost']);
		//GL posting
		if($ok && $data['ItemCost']['cost']>0) {
			//only post to GL if there is a cost
			if($purchaseOrder['PurchaseOrder']['onAccount']) {
				//credit accounts payable or specific vendor account
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
			} else {
				//credit cash account
				$vendorGL_id=$this->ComputareGL->getSlot('payCashcredit');
				if(!$vendorGL_id) {
					//slot "recAPcredit" must be set
					$ok=false;
					$dataSource->rollback();
					throw new NotFoundException(__('The credit slot is not set for Cash in Pay Invoice group.'));
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
			if($ok) $ok=$this->ComputareGL->post(array(
				'Glentry'=>array('created_id'=>$this->Auth->user('id')),
				'debit'=>array($assetGL_id=>$data['ItemCost']['cost']*$data['ItemCost']['qty']),
				'credit'=>array($vendorGL_id=>$data['ItemCost']['cost']*$data['ItemCost']['qty']),
			));
// debug($assetGL_id);debug($ok);exit;
		}//endif
		//serialNumbers
		if($item['Item']['serialized']) {
			//save serial number data
			foreach($data['serialNumbers'] as $num) {
				//loop for all serial numbers and update to the new location
				unset($data['ItemSerialNumber']['id']);
				$data['ItemSerialNumber']['number']=$num;
				$data['ItemSerialNumber']['created_id']=$this->Auth->User('id');
				$data['ItemSerialNumber']['item_id']=$data['item_id'];
				$data['ItemSerialNumber']['item_location_id']=$item_location_id;
				if($ok) $this->Item->ItemSerialNumber->create();
				if($ok) $ok=$this->Item->ItemSerialNumber->save($data['ItemSerialNumber']);
			}//end foreach
		}//endif
// debug($data['ItemSerialNumber']);exit;
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
		//check locks
		if($this->checkLock($il['ItemsLocation']['location_id']) || $this->checkLock($data['location_id'])) $ok=false;
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
	
	/**
	 * issue method
	 * @param $data
		* 'item_location_id' => where issued from  (REQUIRED)
		* 'issueType_id' => type of issue (REQUIRED)
		* 'note' note to add to GL posting (optional)
		* 'serialNumbners'=>array of SN being issued
		*    (OR)
		* 'qty' => qty to issue
	* @return t/f
	*/
	public function issue($data) {
		$this->Location=ClassRegistry::init('Location');
		$this->Item=ClassRegistry::init('Item');
		$this->IssueType=ClassRegistry::init('IssueType');
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
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//start transaction
		$dataSource->begin();
		//check for locks
		if($this->checkLock($il['ItemsLocation']['location_id'])) $ok=false;
		//create transaction
		$trans['created_id']=$this->Auth->User('id');
		$trans['item_id']=$il['ItemsLocation']['item_id'];
		$trans['location_id']=$il['ItemsLocation']['location_id'];
		$trans['qty']=$data['qty']*-1;
		$trans['type']='I';
		if($ok) $ok=$this->Item->ItemTransaction->save($trans);
		unset($trans);
		//items_locations
		if($data['qty']==$il['ItemsLocation']['qty']) {
			//issuing all qty from location
// debug($ok);exit;
			if($ok) $ok=$this->Item->ItemsLocation->delete($data['item_location_id']);
		} else {
			//qty remains at loaction
			$il['ItemsLocation']['qty']-=$data['qty'];
			if($ok) $ok=$this->Item->ItemsLocation->save($il);
		}//endif
		if(isset($data['serialNumbers'])) {
			//item is serialized
			foreach($data['serialNumbers'] as $num) {
				//loop for all serial numbers and update location to 0
				if($ok) $ok=$this->Item->ItemSerialNumber->save(array('id'=>$num,'item_location_id'=>0));
			}//end foreach
		}//endif
		//GL posting
// debug($data);exit;
		$itemCost=$this->getCost($il['ItemsLocation']['item_id'],$data['qty'],true);
		if($itemCost>0) {
			//only post if there is a cost
			$debitAcct_id=$this->IssueType->field('glAccount_id',array('IssueType.id'=>$data['issueType_id'],'IssueType.active'));
			if(!$debitAcct_id) {
				//no specific account for this issue type so get default
				$debitAcct_id=$this->ComputareGL->getSlot('issuedebitDef');
				if(!$debitAcct_id) {
					//default not set
					$dataSource->rollback();
					throw new NotFoundException(__('The debit slot is not set for Cost of Inventory in Issue Inventory group.'));
				}//endif
			}//endif
			$creditAcct_id=$this->ComputareGL->getSlot('issuecredit');
			if(!$creditAcct_id) {
				//account not set
				$dataSource->rollback();
				throw new NotFoundException(__('The credit slot is not set for Cost of Inventory in Issue Inventory group.'));
			}//endif
			//do GL posting
			if(isset($data['note'])) $note=$data['note'];
			else $note=null;
			if($ok) $ok=$this->ComputareGL->post(array(
				'Glentry'=>array('created_id'=>$this->Auth->user('id')),
				'debit'=>array($debitAcct_id=>$itemCost),
				'credit'=>array($creditAcct_id=>$itemCost),
				'Glnote'=>array('text'=>$note),
			));
			
		}//endif
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
	
	/**
	 * adjust method
	 * @param $data
		* $data['item_id']
		* $data['qty'] 
		* $data['cost'] (only used for + qty, - qty uses cost from table)
		* $data['vendor_id'] (required for +qty)
		* $data['location_id']
		* $data['glAccount_id']
		* $data['serialNumbers']=>array of SN (optional, only used for serialized items. if qty+ array of numbers, if qty- array of ids)
		* $data['note'] (optional note for GL posting)
	* @return t/f
	* 
	* used to adjust inventory levels after an inventory count
	* NOES NOT respect locks
	* qty can be +/-
	* item costs will be updated
	*/
	public function adjust($data) {
		$this->Location=ClassRegistry::init('Location');
		$this->Item=ClassRegistry::init('Item');
		$ok=true;
		$dataSource=$this->Location->getDataSource();
		//start transaction
		$dataSource->begin();
		//create transaction
		$trans['created_id']=$this->Auth->User('id');
		$trans['item_id']=$data['item_id'];
		$trans['location_id']=$data['location_id'];
		$trans['qty']=$data['qty'];
		$trans['type']='A';
		if($ok) $this->Item->ItemTransaction->create();
		if($ok) $ok=$this->Item->ItemTransaction->save($trans);
		unset($trans);
		//items_locations data
		$il=$this->Location->ItemsLocation->find('first',array('conditions'=>array('location_id'=>$data['location_id'],'item_id'=>$data['item_id'])));
		if(!$il && $data['qty']<0) $ok=false;
		if(!$il) {
			//item not at location
			if($ok) $this->Location->ItemsLocation->create();
			if($ok) $ok=$this->Location->ItemsLocation->save(array(
				'item_id'=>$data['item_id'],
				'location_id'=>$data['location_id'],
				'qty'=>$data['qty'],
				'creted_id'=>$this->Auth->user('id')
			));
		} else {
			//item at location
			$il['ItemsLocation']['qty']+=$data['qty'];
			if($ok){
				//save qty or delete if qty==0
				if($il['ItemsLocation']['qty']==0) $ok=$this->Location->ItemsLocation->delete($il['ItemsLocation']['id']);
				else $ok=$this->Location->ItemsLocation->save($il);
			}//endif
		}//endif
// debug($data);debug($ok==true);exit;
		//serial numbers
		if(isset($data['serialNumbers'])) {
			if($data['qty']>0) {
				//qty+
				foreach($data['serialNumbers'] as $num) {
					//loop for all serial numbers and add
					if($ok) $this->Item->ItemSerialNumber->create();
					if($ok) $ok=$this->Item->ItemSerialNumber->save(array(
						'number'=>$num,
						'created_id'=>$this->Auth->user('id'),
						'item_id'=>$data['item_id'],
						'item_location_id'=>$il['ItemsLocation']['id']
					));
				}//end foreach
			} else {
				//qty-
				foreach($data['serialNumbers'] as $serial_id) {
					//loop for all serial numbers and update location to 0
					if($ok) $ok=$this->Item->ItemSerialNumber->save(array('id'=>$serial_id,'item_location_id'=>0));
				}//end foreach
			}//endif
		}//endif
		//item cost update
		if($data['qty']>0) {
			//positive qty requires $data['cost'] passed in
			if($data['cost']>0) {
				//ignore cost==0
				if($ok) $this->Item->ItemCost->create();
				if($ok) $ok=$this->Item->ItemCost->save(array(
					'created_id'=>$this->Auth->user('id'),
					'item_id'=>$data['item_id'],
					'vendor_id'=>$data['vendor_id'],
					'cost'=>$data['cost'],
					'qty'=>$data['qty'],
					'remain'=>$data['qty']
				));
			}//endif
			//from now on use total cost of all qty
			$totalCost=$data['cost']*$data['qty'];
		} else {
			//negative qty so use cost method and remove qty
			if($ok) $totalCost=$this->getCost($data['item_id'],$data['qty'],true);
		}//endif
		//GL posting
		if($totalCost>0 and $ok) {
			//only post if cost is >0
			$invAssetAcct_id=$this->ComputareGL->getSlot('issuecredit');
			if(!$invAssetAcct_id) {
				//account not set
				$dataSource->rollback();
				throw new NotFoundException(__('The credit slot is not set for Cost of Inventory in Issue Inventory group.'));
			}//endif
			$glPost=array('Glentry'=>array('created_id'=>$this->Auth->user('id')));
			if(isset($data['note']) && $data['note']!='') $glPost['Glnote']=$data['note'];
			if($data['qty']>0) {
				//qty+
				$glPost['debit']=array($invAssetAcct_id=>$totalCost);
				$glPost['credit']=array($data['glAccount_id']=>$totalCost);
			} else {
				//qty-
				$glPost['debit']=array($data['glAccount_id']=>$totalCost);
				$glPost['credit']=array($invAssetAcct_id=>$totalCost);
			}//endif
			if($ok) $ok=$this->ComputareGL->post($glPost);
		}//endif
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function adjust
	
	/**
	 * getCost method
	 * @param $item_id
	 * @param $qty
	 * @param $remove => used when issuing items
	 * @returns total item cost based on cost method
	 */
	public function getCost($item_id, $qty=1, $remove=false) {
		//returns item cost or 0 if not found
		$costMethod=ClassRegistry::init('Programsetting')->field('cost_method');
		$itemCostOBJ=ClassRegistry::init('ItemCost');
		if($costMethod=='L') {
			//LIFO method
			$costs=$itemCostOBJ->find('all',array(
				'conditions'=>array('ItemCost.item_id'=>$item_id,'ItemCost.remain > 0'),
				'recursive'=>-1,
				'order'=>'created desc'
			));
		}//endif
		if($costMethod=='F') {
			//FIFO method
			$costs=$itemCostOBJ->find('all',array(
				'conditions'=>array('ItemCost.item_id'=>$item_id,'ItemCost.remain > 0'),
				'recursive'=>-1,
				'order'=>'created'
			));
		}// endif
		if($costMethod=='F' || $costMethod=='L') {
			$qtyRemain=$qty;
			$totalCost=0;
			foreach($costs as $cost) {
				//loop through list
				if($qtyRemain>0) {
					//continue finding costs
					if($qtyRemain>$cost['ItemCost']['remain']) {
						//we need more than just this qty
						$totalCost+=$cost['ItemCost']['remain']*$cost['ItemCost']['cost'];
						if($remove) {
							//remove remaining qty
							$cost['ItemCost']['remain']=0;
							$itemCostOBJ->save($cost);
						}//endif
						$qtyRemain-=$cost['ItemCost']['remain'];
					} else {
						//this is enough
						$totalCost+=$qtyRemain*$cost['ItemCost']['cost'];
						if($remove) {
							//remove partial qty
							$cost['ItemCost']['remain']-=$qtyRemain;
							$itemCostOBJ->save($cost);
						}//endif
						$qtyRemain=0;
					}//endif
				}//endif
			}//end foreach
// debug($totalCost);debug($costs);exit;
		}//endif
		if($costMethod=='A') {
			//average cost method
#TODO finish this
		}//endif
		unset($itemCostOBJ);
		return $totalCost;
	}//endif
	
	/**
	 * lockLocation method
	 * @param $data
		* $data['location_id'] (required)
		* $data['notes'] (optional)
	*  @returns t/f
	* used to se a lock on a location and all children that will not allow any item movement
	*/
	public function lockLocation($data) {
		//validate location
		$this->InventoryLock=ClassRegistry::init('InventoryLock');
		$ok=true;
		if($this->checkLock($data['location_id'])) {
			//allready locked
			$ok=false;
		}//endif
		$data['created_id']=$this->Auth->user('id');
		$data['active']=true;
		if($ok) $this->InventoryLock->create();
		if($ok) $ok=$this->InventoryLock->save($data);
		return ($ok==true);
	}//end function lockLocation
	
	/**
	 * unlockLocation method
	 * @param $data
		* $data['inventoryLock_id'] (required)
		* $data['notes'] (optional)
	*  @returns t/f
	* used to se a lock on a location and all children that will not allow any item movement
	*/
	public function unlockLocation($data) {
		//validate location
		$this->InventoryLock=ClassRegistry::init('InventoryLock');
		$ok=true;
		$lock=$this->InventoryLock->find('first',array('conditions'=>array('InventoryLock.id'=>$data['inventoryLock_id'],'InventoryLock.active')));
		if($lock) {
			//lock found-check ownership
			if($lock['InventoryLock']['created_id']!=$this->Auth->user('id') && $this->Auth->user('id')!=1) $ok=false;
			if($ok) {
				//close lock
				$lock['InventoryLock']['removed']=date('Y-m-d H:i:s');
				$lock['InventoryLock']['removed_id']=$this->Auth->user('id');
				$lock['InventoryLock']['active']=false;
				if(isset($data['notes'])) $lock['InventoryLock']['notes']=$data['notes'];
				$ok=$this->InventoryLock->save($lock);
			}//endif
		} else $ok=false;
		return ($ok==true);
	}//end function lockLocation
	
	/**
	 * checkLock method
	 * @param $location_id
	 * @returns inventoryLocks.id or false
	 */
	public function checkLock($location_id) {
		//check all active locks
		$this->InventoryLock=ClassRegistry::init('InventoryLock');
		$isLocked=false;
		$locks=$this->InventoryLock->find('all',array('conditions'=>'InventoryLock.active'));
		//get lft for $location_id
		if($locks) {
			//lock(s) found
			$lft=$this->InventoryLock->Location->field('lft',array('Location.id'=>$location_id));
			if(!$lft) return false;
			foreach($locks as $lock) {
				//loop for all locks
				if($lft>=$lock['Location']['lft'] && $lft<=$lock['Location']['rght']) $isLocked=true;
			}//end foreach
		}//endif
		return $isLocked;
	}//end function checkLock
}