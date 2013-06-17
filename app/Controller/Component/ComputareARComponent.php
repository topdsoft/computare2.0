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
	 * method saveSO
	 * @param array $data
		* For a new SO:
		* $data['SalesOrder']['customer_id'] (required)
		* $data['SalesOrder']['salesOrderType_id'] (required)
		* 
		* For existing SO:
		* $data['SalesOrder']['id'] (required)
		* $data['SalesOrder']['status']=='O' can be changed to
		* $data['SalesOrder']['status']=>'V' to void or
		* $data['SalesOrder']['status']=>'C' to close
	 * @returns t/f
	 */
	public function saveSO($data) {
		//save so data
		$this->SalesOrder=ClassRegistry::init('SalesOrder');
		$this->Customer=ClassRegistry::init('Customer');
		$this->SalesOrderType=ClassRegistry::init('SalesOrderType');
		//validation
		$ok=true;
		if(!isset($data['SalesOrder'])) return false;
		if(isset($data['SalesOrder']['id'])) {
			//existing SO
			unset($data['SalesOrder']['customer_id']);
			unset($data['SalesOrder']['salesOrderType_id']);
			$SO=$this->SalesOrder->read(null,$data['SalesOrder']['id']);
			if($SO) {
				//found ok
				if($SO['SalesOrder']['status']!='O') $ok=false;
				unset($SO);
			} else $ok=false;
// debug($ok);debug($data);exit;
		} else {
			//new SO
			if(!isset($data['SalesOrder']['customer_id'])) return false;
			$this->Customer->id=$data['SalesOrder']['customer_id'];
// debug($this->Customer->field('name'));
			if(!$this->Customer->field('active')) {
				$ok=false;
			}//endif
			if(!isset($data['SalesOrder']['salesOrderType_id'])) return false;
			$this->SalesOrderType->id=$data['SalesOrder']['salesOrderType_id'];
			if(!$this->SalesOrderType->field('active')) {
				$ok=false;
			}//endif
			$data['SalesOrder']['created_id']=$this->Auth->user('id');
			$data['SalesOrder']['status']='O';
			if($ok) $this->SalesOrder->create();
		}//endif
		$dataSource=$this->Customer->getDataSource();
		//start transaction
		$dataSource->begin();
		if(isset($data['SalesOrder']['id'])) {
			if($data['SalesOrder']['status']=='C') {
				//clsoe sales order
				$data['SalesOrder']['closed']=date('Y-m-d H:i:s');
				$data['SalesOrder']['closed_id']=$this->Auth->user('id');
			}//endif
			if($data['SalesOrder']['status']=='V') {
				//void sales order
				$data['SalesOrder']['voided']=date('Y-m-d H:i:s');
				$data['SalesOrder']['voided_id']=$this->Auth->user('id');
			}//endif
		}//endif
		if($ok) $ok=$this->SalesOrder->save($data);
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function saveSO
	
	/**
	 * method saveLine
	 * used to add item or service lines to a sales order
	 * @param array $data
		* $data['SalesOrderDetail']['service_id'] OR $data['SalesOrderDetail']['item_id']
		* $data['SalesOrderDetail']['qty']
		* $data['SalesOrderDetail']['salesOrder_id']
	 * @returns t/f
	 */
	public function saveLine($data) {
		//save item or service line
		$this->SalesOrder=ClassRegistry::init('SalesOrder');
		$this->SalesOrderDetail=ClassRegistry::init('SalesOrderDetail');
		//validation
		if(isset($data['SalesOrderDetail']['service_id']) && isset($data['SalesOrderDetail']['item_id'])) return false;
		if(!isset($data['SalesOrderDetail']['service_id']) && !isset($data['SalesOrderDetail']['item_id'])) return false;
		$so=$this->SalesOrder->read(null,$data['SalesOrderDetail']['salesOrder_id']);
		if(!$so) return false;
		if($so['SalesOrder']['status']!='O') return false;
		//save line
		$ok=$this->SalesOrderDetail->save($data);
		return ($ok==true);
// debug($data);exit;
	}//end public function saveline
	
	/**
	 * method removeLine
	 * used to remove a line from an open SO
	 * @param $id  => the salesOrderDetails.id to be removed
	 * @return t/f
	 */
	public function removeLine($id) {
		//remove a line from SO
		$this->SalesOrder=ClassRegistry::init('SalesOrder');
		$this->SalesOrderDetail=ClassRegistry::init('SalesOrderDetail');
		//validation
		$this->SalesOrderDetail->id=$id;
		if(!$this->SalesOrderDetail->exists()) return false;
		$data=$this->SalesOrderDetail->read();
		if($data['SalesOrderDetail']['active']==false) return false;
		if($data['SalesOrder']['status']!='O') return false;
		//remove line
		$saveData=array('id'=>$id);
		$saveData['active']=false;
		$saveData['removed']=date('Y-m-d H:i:s');
		$saveData['removed_id']=$this->Auth->user('id');
		return $this->SalesOrderDetail->save($saveData);
	}
	
	/** method completeSale
	 * used to invoice a sale and update AP and or inventory
	 * @param $data array(
		* ['SalesOrderType'] => array (
			* 'on_account'  t/f
			* 'shipping'   t/f
		* )
		* ['SalesOrder'] => array (
			* 'id'
			* 'shipping'  shipping amount  (optional)
			* 'paymentType_id'
			* 'expense'  payment expense amount (optional)
			* 'identification'  payment identification  (optional  ex: check#)
		* )
	 * )
	 * @returns t/f
	 */
	public function completeSale($data) {
		$this->SalesOrder=ClassRegistry::init('SalesOrder');
debug($data);exit;
		
	}
	
	/**
	 * method setItemPrice
	 * used to setup pricing on items to be sold
	 * @param arary $data
		* $data['Item']['id'] => item to change (required)
		* $data['Default'] => array(x => array('price','qty','id'))
		* $data['Customer'] => array(customer_id => array('price','qty','id'))
		* $data['CustomerGroup'] => array(customerGroup_id => array('price','qty','id'))
	* @return t/f
	*/
	public function setItemPrice($data){
		//save price
		$this->Item=ClassRegistry::init('Item');
		$this->CustomersItem=ClassRegistry::init('CustomersItem');
		$this->CustomerGroupsItem=ClassRegistry::init('CustomerGroupsItem');
		$this->Customer=ClassRegistry::init('Customer');
		$this->CustomerGroup=ClassRegistry::init('CustomerGroup');
		//validation
		if(!isset($data['Item']['id'])) return false;
		$this->Item->id=$data['Item']['id'];
		if(!$this->Item->exists()) return false;
		$ok=true;
		$dataSource=$this->Customer->getDataSource();
		//start transaction
		$dataSource->begin();
// debug($data);exit;
		if(isset($data['Customer'])) {
			//price for customer
			foreach($data['Customer'] as $customer_id=>$custData) {
				//loop for each different customer
				foreach($custData as $p) {
					//loop for each price point for this customer
					if($p['qty']!='' && $p['price']!='') {
						//ignore empty records
						if($p['id']) {
							//record exists- check for changes
							$record=$this->CustomersItem->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$p['id'])));
							if($p['qty']!=$record['CustomersItem']['qty']  || $p['price']!= $record['CustomersItem']['price']){
								//need to remove old record and add new
								$record['CustomersItem']['active']=false;
								$record['CustomersItem']['deleted']=date('Y-m-d H:i:s');
								$record['CustomersItem']['deleted_id']=$this->Auth->user('id');
								if($ok) $ok=$this->CustomersItem->save($record);
								//create new record
								$p['item_id']=$data['Item']['id'];
								$p['customer_id']=$customer_id;
								$p['active']=true;
								$p['created_id']=$this->Auth->user('id');
								unset($p['id']);
								if($ok) $this->CustomersItem->create();
								if($ok) $ok=$this->CustomersItem->save($p);
// debug($record);exit;
							}//endif
						} else {
							//create new record
							$p['item_id']=$data['Item']['id'];
							$p['customer_id']=$customer_id;
							$p['active']=true;
							$p['created_id']=$this->Auth->user('id');
							if($ok) $ok=$this->CustomersItem->save($p);
						}//endif
					}//endif
				}//end foreach
			}//end foreach
		}//endif
		if(isset($data['CustomerGroup'])) {
			//price for group
			foreach($data['CustomerGroup'] as $customerGroup_id=>$custData) {
				//loop for each different customer group
				foreach($custData as $p) {
					//loop for each price point for this group
					if($p['qty']!='' && $p['price']!='') {
						//ignore empty records
						if($p['id']) {
							//record exists- check for changes
							$record=$this->CustomerGroupsItem->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$p['id'])));
							if($p['qty']!=$record['CustomerGroupsItem']['qty']  || $p['price']!= $record['CustomerGroupsItem']['price']){
								//need to remove old record and add new
								$record['CustomerGroupsItem']['active']=false;
								$record['CustomerGroupsItem']['deleted']=date('Y-m-d H:i:s');
								$record['CustomerGroupsItem']['deleted_id']=$this->Auth->user('id');
								if($ok) $ok=$this->CustomerGroupsItem->save($record);
								//create new record
								$p['item_id']=$data['Item']['id'];
								$p['customerGroup_id']=$customerGroup_id;
								$p['active']=true;
								$p['created_id']=$this->Auth->user('id');
								unset($p['id']);
								if($ok) $this->CustomerGroupsItem->create();
								if($ok) $ok=$this->CustomerGroupsItem->save($p);
// debug($record);exit;
							}//endif
						} else {
							//create new record
							$p['item_id']=$data['Item']['id'];
							$p['customerGroup_id']=$customerGroup_id;
							$p['active']=true;
							$p['created_id']=$this->Auth->user('id');
							if($ok) $ok=$this->CustomerGroupsItem->save($p);
						}//endif
					}//endif
				}//end foreach
			}//end foreach
		}//endif
		if(isset($data['Default'])) {
			//default pricing
			foreach($data['Default'] as $p) {
				//loop for all default prices
				if($p['qty']!='' && $p['price']!='') {
					//ignore empty records
					if($p['id']) {
						//record exists so check if it has changed
						$record=$this->CustomerGroupsItem->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$p['id'])));
						if($p['qty']!=$record['CustomerGroupsItem']['qty']  || $p['price']!= $record['CustomerGroupsItem']['price']){
							//need to remove old record and add new
							$record['CustomerGroupsItem']['active']=false;
							$record['CustomerGroupsItem']['deleted']=date('Y-m-d H:i:s');
							$record['CustomerGroupsItem']['deleted_id']=$this->Auth->user('id');
							if($ok) $ok=$this->CustomerGroupsItem->save($record);
							//create new record
							$p['item_id']=$data['Item']['id'];
							$p['active']=true;
							$p['created_id']=$this->Auth->user('id');
							unset($p['id']);
							if($ok) $this->CustomerGroupsItem->create();
							if($ok) $ok=$this->CustomerGroupsItem->save($p);
// debug($record);exit;
						}//endif
					} else {
						//create new record
						$p['item_id']=$data['Item']['id'];
						$p['active']=true;
						$p['created_id']=$this->Auth->user('id');
						if($ok) $ok=$this->CustomerGroupsItem->save($p);
					}//endif
				}//endif
			}//end foreach
		}//endif
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end function
	
	/**
	 * method getPrice
	 * @return each price of item for customer
	 * @param int $customer_id
	 * @param int $item_id
	 * @param int $qty
	 */
	public function getPrice($customer_id,$item_id,$qty) {
		//setup
		$this->Customer=ClassRegistry::init('Customer');
		$this->Item=ClassRegistry::init('Item');
		$this->CustomersItem=ClassRegistry::init('CustomersItem');
		$this->CustomerGroupsItem=ClassRegistry::init('CustomerGroupsItem');
		//validation
		$this->Customer->id=$customer_id;
		if(!$this->Customer->exists()) return false;
		$this->Item->id=$item_id;
		if(!$this->Item->exists()) return false;
		$price=false;
		//get default price
		$p=$this->CustomerGroupsItem->find('first',array('recursive'=>-1,'order'=>'qty desc','conditions'=>array('item_id'=>$item_id,'customerGroup_id'=>null,'CustomerGroupsItem.active','qty <'=>$qty)));
		if($p) $price=$p['CustomerGroupsItem']['price'];
		//get individual customer price
		$p=$this->CustomersItem->find('first',array('recursive'=>-1,'order'=>'qty desc','conditions'=>array('item_id'=>$item_id,'customer_id'=>$customer_id,'active','qty <'=>$qty)));
		if($p && $p['CustomersItem']['price']<$price) $price=$p['CustomersItem']['price'];
		if($p && $price==false) $price=$p['CustomersItem']['price'];
		//get customer group pricing
		$customer=$this->Customer->read();
		if($customer['Customer']['customerGroup_id']) {
			//get group pricing
			$p=$this->CustomerGroupsItem->find('first',array('recursive'=>-1,'order'=>'qty desc','conditions'=>array('item_id'=>$item_id,'customerGroup_id'=>$customer['Customer']['customerGroup_id'],'CustomerGroupsItem.active','qty <'=>$qty)));
			if($p && $p['CustomerGroupsItem']['price']<$price) $price=$p['CustomerGroupsItem']['price'];
			if($p && $price==false) $price=$p['CustomerGroupsItem']['price'];
		}//endif
// debug($p);debug($price);debug($qty);exit;
		unset($p,$customer);
		return $price;
	}
}