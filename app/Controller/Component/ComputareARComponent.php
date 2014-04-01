<?php
/**
 * ComputareARComponent.php
 * 
 * Part of computare accounting system used to edit accounts receivable
 * */

App::uses('Component','Controller');
class ComputareARComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie','ComputareGL','ComputareSysevent','ComputareIC');
	
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
		$this->Invoice=ClassRegistry::init('Invoice');
		$this->Item=ClassRegistry::init('Item');
		$this->Sale=ClassRegistry::init('Sale');
		//get so
		$SO=$this->SalesOrder->find('first',array('recursive'=>2,'conditions'=>array('SalesOrder.id'=>$data['SalesOrder']['id'])));
		$ok=true;
		$dataSource=$this->SalesOrder->getDataSource();
		//start transaction
		$dataSource->begin();
		##invoice
		if($ok) $this->Invoice->create();
		if($ok) $ok=$this->Invoice->save(array(
			'created_id'=>$this->Auth->user('id'),
			'status'=>'O',
			'salesOrder_id'=>$data['SalesOrder']['id'],
			'customer_id'=>$SO['SalesOrder']['customer_id']
		));
		$invoice_id=$this->Invoice->getInsertId();
		$tax=0;
		$itemTotal=0;
		$serviceTotal=0;
		foreach($SO['ItemDetail'] as $item) {
			//loop for all items and add to invoice
			if($ok) $this->Invoice->InvoiceDetail->create();
			//build text
			$text=$item['qty'].' '.$item['Item']['name'];
			if($item['qty']>1) $text.='s';
			$text.=' @ '.$item['price'].' each';
			if($ok) $ok=$this->Invoice->InvoiceDetail->save(array(
				'invoice_id'=>$invoice_id,
				'created_id'=>$this->Auth->user('id'),
				'active'=>true,
				'text'=>$text,
				'amount'=>$item['price']*$item['qty'],
			));
			$tax+=$item['tax'];
			$itemTotal+=$item['price']*$item['qty'];
			unset($text);
		}//end foreach
		foreach($SO['ServiceDetail'] as $service) {
			//loop for all service details and add to invoice
			if($ok) $this->Invoice->InvoiceDetail->create();
			//construct text
			$text=$service['Service']['name'].' '.$service['qty'].' @ '.$service['price'];
			if($ok) $ok=$this->Invoice->InvoiceDetail->save(array(
				'invoice_id'=>$invoice_id,
				'created_id'=>$this->Auth->user('id'),
				'active'=>true,
				'text'=>$text,
				'amount'=>$service['price']*$service['qty'],
			));
			$tax+=$service['tax'];
			$serviceTotal+=$service['price']*$service['qty'];
		}//end foreach
		if($tax) {
			//add a line for tax
			if($ok) $this->Invoice->InvoiceDetail->create();
			if($ok) $ok=$this->Invoice->InvoiceDetail->save(array(
				'invoice_id'=>$invoice_id,
				'created_id'=>$this->Auth->user('id'),
				'active'=>true,
				'text'=>'Taxes',
				'amount'=>$tax,
			));
		}//endif
		//set status to invoiced
		$status='I';
		$shippingPaid=0;
		if(isset($data['SalesOrder']['shipping'])) $shippingPaid=$data['SalesOrder']['shipping'];
		$totalPaid=$itemTotal+$serviceTotal+$tax+$shippingPaid;
// debug($data);debug($SO);debug($totalPaid);//exit;
		##payment
		##gl posting
		$glPost=array('debit'=>array(),'credit'=>array());
		//set user id
		$glPost['Glentry']['created_id']=$this->Auth->user('id');
		//add each gl entry defined in SOtype
		if($itemTotal!=0) {
			//don't post if zero
			if($SO['SalesOrderType']['itemTotalDebitAcct_id']) {
				//post to item total debit acct
				if(!isset($glPost['debit'][$SO['SalesOrderType']['itemTotalDebitAcct_id']])) $glPost['debit'][$SO['SalesOrderType']['itemTotalDebitAcct_id']]=(float)$itemTotal;
				else $glPost['debit'][$SO['SalesOrderType']['itemTotalDebitAcct_id']]+=$itemTotal;
			}//endif
			if($SO['SalesOrderType']['itemTotalCreditAcct_id']) {
				//post to item total credit acct
				if(!isset($glPost['credit'][$SO['SalesOrderType']['itemTotalCreditAcct_id']])) $glPost['credit'][$SO['SalesOrderType']['itemTotalCreditAcct_id']]=(float)$itemTotal;
				else $glPost['credit'][$SO['SalesOrderType']['itemTotalCreditAcct_id']]+=$itemTotal;
			}//endif
		}//endif
		if($serviceTotal!=0) {
			//no zero posting
			if($SO['SalesOrderType']['serviceTotalDebitAcct_id']) {
				//post to service total debit acct
				if(!isset($glPost['debit'][$SO['SalesOrderType']['serviceTotalDebitAcct_id']])) $glPost['debit'][$SO['SalesOrderType']['serviceTotalDebitAcct_id']]=(float)$serviceTotal;
				else $glPost['debit'][$SO['SalesOrderType']['serviceTotalDebitAcct_id']]+=$serviceTotal;
			}//endif
			if($SO['SalesOrderType']['serviceTotalCreditAcct_id']) {
				//post to service total credit acct
				if(!isset($glPost['credit'][$SO['SalesOrderType']['serviceTotalCreditAcct_id']])) $glPost['credit'][$SO['SalesOrderType']['serviceTotalCreditAcct_id']]=(float)$serviceTotal;
				else $glPost['credit'][$SO['SalesOrderType']['serviceTotalCreditAcct_id']]+=$serviceTotal;
			}//endif
		}//endif
		if($shippingPaid!=0) {
			//no zero posting
			if($SO['SalesOrderType']['shippingDebitAcct_id']) {
				//post to shipping total debit acct
				if(!isset($glPost['debit'][$SO['SalesOrderType']['shippingDebitAcct_id']])) $glPost['debit'][$SO['SalesOrderType']['shippingDebitAcct_id']]=(float)$shippingPaid;
				else $glPost['debit'][$SO['SalesOrderType']['shippingDebitAcct_id']]+=$shippingPaid;
			}//endif
			if($SO['SalesOrderType']['shippingCreditAcct_id']) {
				//post to shipping total credit acct
				if(!isset($glPost['credit'][$SO['SalesOrderType']['shippingCreditAcct_id']])) $glPost['credit'][$SO['SalesOrderType']['shippingCreditAcct_id']]=(float)$shippingPaid;
				else $glPost['credit'][$SO['SalesOrderType']['shippingCreditAcct_id']]+=$shippingPaid;
			}//endif
		}//endif
		if($tax!=0) {
			//no zero posting
			if($SO['SalesOrderType']['taxDebitAcct_id']) {
				//post to tax total debit acct
				if(!isset($glPost['debit'][$SO['SalesOrderType']['taxDebitAcct_id']])) $glPost['debit'][$SO['SalesOrderType']['taxDebitAcct_id']]=(float)$tax;
				else $glPost['debit'][$SO['SalesOrderType']['taxDebitAcct_id']]+=$tax;
			}//endif
			if($SO['SalesOrderType']['taxCreditAcct_id']) {
				//post to tax total credit acct
				if(!isset($glPost['credit'][$SO['SalesOrderType']['taxCreditAcct_id']])) $glPost['credit'][$SO['SalesOrderType']['taxCreditAcct_id']]=(float)$tax;
				else $glPost['credit'][$SO['SalesOrderType']['taxCreditAcct_id']]+=$tax;
			}//endif
		}//endif
		if($totalPaid!=0) {
			//no zero posting (but should never be zero)
			if($SO['SalesOrderType']['grandTotalDebitAcct_id']) {
				//post to grand total debit acct
				if(!isset($glPost['debit'][$SO['SalesOrderType']['grandTotalDebitAcct_id']])) $glPost['debit'][$SO['SalesOrderType']['grandTotalDebitAcct_id']]=(float)$totalPaid;
				else $glPost['debit'][$SO['SalesOrderType']['grandTotalDebitAcct_id']]+=$totalPaid;
			}//endif
			if($SO['SalesOrderType']['grandTotalCreditAcct_id']) {
				//post to grand total credit acct
				if(!isset($glPost['credit'][$SO['SalesOrderType']['grandTotalCreditAcct_id']])) $glPost['credit'][$SO['SalesOrderType']['grandTotalCreditAcct_id']]=(float)$totalPaid;
				else $glPost['credit'][$SO['SalesOrderType']['grandTotalCreditAcct_id']]+=$totalPaid;
			}//endif
		}//enidf
		//get soType
		$soType=$this->SalesOrder->SalesOrderType->read(null,$SO['SalesOrderType']['id'] );
		foreach($soType['SalesOrderFee'] as $fee) {
			//loop for all fees
			if(isset($data['SalesOrderFee'][$fee['id']]) && $data['SalesOrderFee'][$fee['id']]!=0) {
				//be sure fee was passed and is not zero
				$feeAmount=$data['SalesOrderFee'][$fee['id']];
				//post to debit and credit accounts
				if(!isset($glPost['debit'][$fee['debitAccount_id']])) $glPost['debit'][$fee['debitAccount_id']]=(float)$feeAmount;
				else $glPost['debit'][$fee['debitAccount_id']]+=$feeAmount;
				if(!isset($glPost['credit'][$fee['creditAccount_id']])) $glPost['credit'][$fee['creditAccount_id']]=(float)$feeAmount;
				else $glPost['credit'][$fee['creditAccount_id']]+=$feeAmount;
				//add salesOrderMod to sales order
				if($ok)$this->SalesOrder->SalesOrderMod->create();
				if($ok)$ok=$this->SalesOrder->SalesOrderMod->save(array(
					'created_id'=>$this->Auth->user('id'),
					'salesOrder_id'=>$SO['SalesOrder']['id'],
					'label'=>$fee['label'],
					'amount'=>$feeAmount
				));
				unset($feeAmount);
			}//endif
		}//end foreach
		//do gl posting
		if($ok) $ok=$this->ComputareGL->post($glPost);
		##create sale entries
		foreach($SO['ItemDetail'] as $item) {
			//loop for all items on SO and create a sale record for it
			if($ok) $this->Sale->create();
			if($ok) $ok=$this->Sale->save(array(
				'created_id'=>$this->Auth->user('id'),
				'item_id'=>$item['Item']['id'],
				'salesOrderDetail_id'=>$item['id'],
				'customer_id'=>$SO['SalesOrder']['customer_id']
			));
		}//endif
		##issue stock if a direct sale (not using shipping option)
// debug($data);debug($SO);debug($totalPaid);//exit;
		if($SO['SalesOrderType']['shipping']==false) {
			//get array of locations where item could be found
			$saleLocation=$this->Item->Location->find('first',array(
				'conditions'=>array('Location.id'=>$SO['SalesOrderType']['location_id']),
				'fields'=>array('Location.lft','Location.rght'),
				'recursive'=>0,
			));
			$saleLocations=$this->Item->Location->find('list',array(
				'conditions'=>array('Location.lft >= '.$saleLocation['Location']['lft'],'Location.lft <= '.$saleLocation['Location']['rght']),
				'fields'=>array('Location.id'),
			));
			unset($saleLocation);
	debug($saleLocations);
			foreach($SO['ItemDetail'] as $item) {
				//loop for all items
				$loc=$this->Item->ItemsLocation->find('all',array('conditions'=>array('location_id'=>$saleLocations,'item_id'=>$item['item_id'])));
	debug($loc);debug($item);exit;
				if($loc) {
					//item found at sale location
					$qtyAval=0;
					//get total qty available
					foreach($loc as $il) $qtyAval+=$il['ItemsLocation']['qty'];
					if($qtyAval>=$item['qty']) {
						//there is sufficient qty
						$qtyRemaining=$item['qty'];
						foreach($loc as $il) {
							//loop for each location where this item is at
							if($qtyRemaining>0) {
								//more stock to issue
								if($il['ItemsLocation']['qty']>=$qtyRemaining) {
									//enough here to fulfill
									$issueQty=$qtyRemaining;
								} else {
									//not enough here so take all
									$issueQty=$il['ItemsLocation']['qty'];
								}//endif
								if($ok) $ok=$this->ComputareIC->issue(array(
									'item_location_id'=>$il['ItemsLocation']['id'],
									'issueType_id'=>$SO['SalesOrderType']['issueType_id'],
									'Item'=>array(
										'qty'=>$issueQty)));
							}//endif
						}//end foreach $loc
						//mod SOdetail line
						if($ok) $ok=$this->SalesOrder->SalesOrderDetail->save(array(
							'id'=>$item['id'],
							'shipped'=>$item['qty']
						));
					} else {
						//there is NOT sufficient qty
						$ok=false;
						$error=array(
							'event_type'=>1,
							'title'=>'Item on SO insufficient qty',
							'errorEvent'=>array(
								'message'=>'SO: '.$item['SalesOrder']['id'].' Item: '.$item['Item']['name'].' Qty: '.$item['qty']));
	#####TODO change this later for oversale
					}//endif
				} else {
					//item not found at sale location
					$ok=false;
					$error=array(
						'event_type'=>1,
						'title'=>'Item on SO not found at location',
						'errorEvent'=>array(
							'message'=>'SO: '.$item['SalesOrder']['id'].' Item: '.$item['Item']['name'].' Qty: '.$item['qty']));
				}//endif
			}//end foreach
			//set status to closed
			$status='C';
		}//endif not using shipping
debug('here');exit;
		
		
		//save changes to SO
		if($ok) $ok=$this->SalesOrder->save(array(
			'id'=>$SO['SalesOrder']['id'],
			'status'=>$status,
			'invoice_id'=>$invoice_id,
			'shipping_paid'=>$shippingPaid,
		));
		
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		if(isset($error)) {
			//post error (must be done here after rollback)
			$this->ComputareSysevent->save($error);
		}//endif
		return ($ok==true);
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