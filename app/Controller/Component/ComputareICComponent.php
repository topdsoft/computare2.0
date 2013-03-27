<?php
/**
 * ComputareICComponent.php
 * 
 * Part of computare accounting system used to edit items
 * */

App::uses('Component','Controller');
class ComputareICComponent extends Component{
	/**
	 * saveItem method
	 * @param $data
	 * used to save item data
	 */
	public $components = array('Auth', 'Session', 'Cookie');
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
}