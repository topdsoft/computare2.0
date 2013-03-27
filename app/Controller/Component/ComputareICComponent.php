<?php
/**
 * ComputareICComponent.php
 * 
 * Part of computare accounting system used to edit items
 * */

App::uses('Component','Controller');
class ComputareICComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie');
	
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
		if($data['Item']['id']) {
			//editing existing item
		} else {
			//creating new item
			if($ok) $ok=$this->Item->save($data['Item']);
			if($ok) $data['Item']['id']=$this->Item->getInsertId();
		}//endif
		$data['ItemDetail']['item_id']=$data['Item']['id'];
		$data['ItemDetail']['created_id']=$this->Auth->User('id');
		//save itemDetails
		if($ok) $ok=$this->ItemDetail->save($data['ItemDetail']);
		//update itemDetail_id
		$data['Item']['itemDetail_id']=$this->ItemDetail->getInsertId();
		if($ok) $ok=$this->Item->save($data['Item']);
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
		//get purchase order
		$purchaseOrder=$this->PurchaseOrder->read(null,$data['purchaseOrder_id']);
// debug($purchaseOrder);
		if(!$purchaseOrder) return false;
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
		if($ok) $ok=$this->Item->ItemTransaction->save($data['ItemTransaction']);
		//create entry in items_locations table
		$data['Item_Location']['created_id']=$this->Auth->User('id');
		$data['Item_Location']['item_id']=$data['item_id'];
		$data['Item_Location']['location_id']=$data['location_id'];
		$data['Item_Location']['qty']=$data['qty'];
		if($ok) $ok=$this->Item->ItemsLocation->save($data['Item_Location']);
		//update purchase order details
		$poDetail=$this->PurchaseOrder->PurchaseOrderDetail->find('first',array('conditions'=>array('purchaseOrder_id'=>$data['purchaseOrder_id'], 'item_id'=>$data['item_id'])));
		if(!$poDetail) {
			//item not found on this po
			if($purchaseOrder['PurchaseOrder']['allowOpen']) {
				//po is ok for adding new items
				$data['PurchaseOrderDetails']['created_id']=$this->Auth->User('id');
				$data['PurchaseOrderDetails']['purchaseOrder_id']=$data['purchaseOrder_id'];
				$data['PurchaseOrderDetails']['item_id']=$data['item_id'];
				$data['PurchaseOrderDetails']['rec']=$data['qty'];
				//??cost
			} else $ok=false;
		} else {
			//item found on po
			$data['PurchaseOrderDetails']['id']=$poDetail['id'];
			$data['PurchaseOrderDetails']['rec']=$poDetail['rec']+$data['qty'];
		}//endif
		if($ok) $ok=$this->PurchaseOrder->PurchaseOrderDetail->save($data['PurchaseOrderDetails']);
		//insert into itemCosts table
		$data['ItemCosts']['created_id']=$this->Auth->User('id');
		$data['ItemCosts']['item_id']=$data['item_id'];
		$data['ItemCosts']['vendor_id']=$purchaseOrder['PurchaseOrder']['vendor_id'];
		//????cost
		$data['ItemCosts']['qty']=$data['qty'];
// debug($data);exit;
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function receive
}