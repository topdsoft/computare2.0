<?php
App::uses('AppController', 'Controller');
/**
 * InventoryCounts Controller
 *
 * @property InventoryCount $InventoryCount
 */
class InventoryCountsController extends AppController {

	public $components=array('ComputareIC','ComputareGL');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Inventory Counts');
		$this->set('menu_add',true);
		$this->InventoryCount->recursive = 0;
		$this->set('inventoryCounts', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Inventory Count');
		$this->InventoryCount->id = $id;
		if (!$this->InventoryCount->exists()) {
			throw new NotFoundException(__('Invalid inventory count'));
		}
		//get count data
// 		$this->InventoryCount->recursive = 2;
		$ic=$this->InventoryCount->read(null, $id);
		//get item qty for actual and count
		foreach($ic['Location'] as $i=>$location) {
			//loop for all locations in count
			$ic['Location'][$i]['Item']=array();
			//find items currently at this location
			$items=$this->InventoryCount->Location->ItemsLocation->find('all',array('conditions'=>array('location_id'=>$location['id'])));
			foreach($items as $item) {
				//loop for all items and add qty to array
				$ic['Location'][$i]['Item'][$item['ItemsLocation']['item_id']]['curQty']=$item['ItemsLocation']['qty'];
			}//end foreach
			unset($items);
			//find items counted at this location
			$items=$this->InventoryCount->ItemCount->find('all',array('recursive'=>-1,'conditions'=>array('inventoryCount_id'=>$id,'location_id'=>$location['id'])));
			foreach($items as $item) {
				//loop for all items and add qty to array
				$ic['Location'][$i]['Item'][$item['ItemCount']['item_id']]['cntQty']=$item['ItemCount']['qty'];
			}//end foreach
		}//end foreach
		$this->set('inventoryCount', $ic);
		//get users list
		$this->set('users',ClassRegistry::init('User')->find('list'));
		//get item name list
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Inventory Count');
		$this->set('add_menu',true);
		if ($this->request->is('post')) {
			//start a new inventory count
			$this->request->data['InventoryCount']['active']=true;
			$this->request->data['InventoryCount']['created_id']=$this->Auth->user('id');
			$this->InventoryCount->create();
			if ($this->InventoryCount->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory count has been started'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$this->InventoryCount->getInsertId()));
			} else {
				$this->Session->setFlash(__('The inventory count could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Inventory Count');
		$this->InventoryCount->id = $id;
		if (!$this->InventoryCount->exists()) {
			throw new NotFoundException(__('Invalid inventory count'));
		}
		//find locations allready in count
		$current=$this->InventoryCount->InventoryCountsLocation->find('list',array('recursive'=>-1,'fields'=>array('location_id'),'conditions'=>array('inventoryCount_id'=>$id)));
		if ($this->request->is('post') || $this->request->is('put')) {
			//save new location and notes
			$lft=$this->InventoryCount->Location->field('lft',array('Location.id'=>$this->request->data['InventoryCount']['location_id']));
			$rght=$this->InventoryCount->Location->field('rght',array('Location.id'=>$this->request->data['InventoryCount']['location_id']));
			//find selected location and all children
			$locations=$this->InventoryCount->Location->find('all',array('recursive'=>-1,'conditions'=>array('Location.lft <='=>$rght,'Location.lft >='=>$lft)));
// debug($locations);debug($current);exit;
			foreach($locations as $location) {
				//loop for all locations and check if they are allreasy in count
				if(!in_array($location['Location']['id'],$current)) {
					//ok to add
					$this->InventoryCount->InventoryCountsLocation->create();
					$this->InventoryCount->InventoryCountsLocation->save(array('location_id'=>$location['Location']['id'],'inventoryCount_id'=>$id));
				}//endif
			}//end foreach
// debug($this->request->data);exit;
			if ($this->InventoryCount->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been added'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory count could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->InventoryCount->read(null, $id);
		}
		$locations = $this->InventoryCount->Location->find('list',array('conditions'=>array('not'=>array('id'=>$current))));
		$this->set(compact('locations'));
	}

/**
 * count method
 * 
 * @param $id inventoryCount_id
 */
	public function count($id) {
		//validate id
		$this->InventoryCount->id = $id;
		$count=$this->InventoryCount->read();
		if(!$count) {
			//not found
			$this->Session->setFlash(__('The count could not be found'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if($count['InventoryCount']['finished']) {
			//count allrady completed
			$this->Session->setFlash(__('The count is marked as completed'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//check return data
			if(isset($this->request->data['InventoryCount']['item_id'])) {
				//add an item
// debug($this->request->data);exit;
				$itemCount=$this->InventoryCount->ItemCount->find('first',array('recursive'=>-1,'conditions'=>array(
					'item_id'=>$this->request->data['InventoryCount']['item_id'],
					'location_id'=>$this->request->data['InventoryCount']['location_id'],
					'inventoryCount_id'=>$id
				)));
				if($itemCount){
					//item has been counted here before so add results
					$itemCount['ItemCount']['qty']+=$this->request->data['InventoryCount']['qty'];
					if($this->InventoryCount->ItemCount->save($itemCount)) {
						//saved ok
						$this->Session->setFlash(__('The item qty has been updated'),'default',array('class'=>'success'));
						unset($this->request->data['InventoryCount']['qty']);
						unset($this->request->data['InventoryCount']['item_id']);
					} else {
						//fail?
						$this->Session->setFlash(__('The item qty could not be updated'));
					}//endif
					unset($itemCount);
				} else {
					//first time for item counting here
					if($this->InventoryCount->ItemCount->save(array(
						'created_id'=>$this->Auth->user('id'),
						'item_id'=>$this->request->data['InventoryCount']['item_id'],
						'location_id'=>$this->request->data['InventoryCount']['location_id'],
						'inventoryCount_id'=>$id,
						'qty'=>$this->request->data['InventoryCount']['qty'],
					))) {
						//saved ok
						$this->Session->setFlash(__('The item qty has been updated'),'default',array('class'=>'success'));
						unset($this->request->data['InventoryCount']['qty']);
						unset($this->request->data['InventoryCount']['item_id']);
					} else {
						//not saved ok
						$this->Session->setFlash(__('The item qty could not be updated'));
					}//endif
				}//endif
			}//endif
		}//endif
		//get count locations
		$this->set('locations',$this->InventoryCount->Location->find('list',array('conditions'=>array('id'=>$this->InventoryCount->InventoryCountsLocation->find('list',array('fields'=>array('location_id'),'conditions'=>array('inventoryCount_id'=>$id,'finished'=>null)))))));
		if(isset($this->request->data['InventoryCount']['location_id'])) {
			//get count qtys
			$this->set('counts',$this->InventoryCount->ItemCount->find('all',array('conditions'=>array('inventoryCount_id'=>$id,'location_id'=>$this->request->data['InventoryCount']['location_id']))));
			//get item list
			$this->set('items',ClassRegistry::init('Item')->find('list'));
			//get inventoryCountsLocation_id
			$this->set('inventoryCountsLocation_id',$this->InventoryCount->InventoryCountsLocation->field('id',array('inventoryCount_id'=>$id,'location_id'=>$this->request->data['InventoryCount']['location_id'])));
		}//endif
		$this->set('inventoryCount',$count);
	}//endif

/**
 * finishCount method
 * 
 * @param $id  inventoryCount_id
 */
	public function finishCount($id) {
		//validate
		$this->InventoryCount->id = $id;
		$count=$this->InventoryCount->read();
		if(!$count) {
			//not found
			$this->Session->setFlash(__('The count could not be found'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if($count['InventoryCount']['finished']) {
			//count allrady completed
			$this->Session->setFlash(__('The count is marked as completed'));
			$this->redirect(array('action' => 'index'));
		}//endif
		$count['InventoryCount']['finished']=date('Y-m-d h:m:s');
		$count['InventoryCount']['active']=false;
		$this->InventoryCount->save($count);
#TODO unlock
		$this->Session->setFlash(__('The count has been marked as finished'),'default',array('class'=>'success'));
		$this->redirect(array('action'=>'index'));
	}

/**
 * finish method
 * 
 * @param $inventoryCountsLocation_id  to finish
 */
	public function finish($inventoryCountsLocation_id) {
		//validate
		$icl=$this->InventoryCount->InventoryCountsLocation->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$inventoryCountsLocation_id)));
		if(!$icl) {
			//invalid
			$this->Session->setFlash(__('The count could not be found'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if($icl['InventoryCountsLocation']['finished']) {
			//allready finished
			$this->Session->setFlash(__('This location is allready marked as finsihed'));
			$this->redirect(array('action' => 'index'));
		}//endif
// debug($icl);exit;
		$icl['InventoryCountsLocation']['finished']=date('Y-m-d h:m:s');
		$icl['InventoryCountsLocation']['finished_id']=$this->Auth->user('id');
		if($this->InventoryCount->InventoryCountsLocation->save($icl)) {
			//saved ok
			$this->Session->setFlash(__('The location has been marked as finished'),'default',array('class'=>'success'));
			$this->redirect(array('action'=>'count',$icl['InventoryCountsLocation']['inventoryCount_id']));
		} else {
			//not saved
			$this->Session->setFlash(__('The location could not be marked finsihed'));
			$this->redirect(array('action'=>'count',$icl['InventoryCountsLocation']['inventoryCount_id']));
		}//endif
	}
	
/**
 * recount method
 * 
 * @param $inventoryCountsLocation_id  to recount
 * will delete record and force recount of location
 */
	public function recount($inventoryCountsLocation_id) {
		$this->set('formName','Recount Inventory');
		//validate
		$icl=$this->InventoryCount->InventoryCountsLocation->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$inventoryCountsLocation_id)));
		if(!$icl) {
			//invalid
			$this->Session->setFlash(__('The count could not be found'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if(!$icl['InventoryCountsLocation']['finished']) {
			//not finished
			$this->Session->setFlash(__('This location is not marked as finished'));
			$this->redirect(array('action' => 'index'));
		}//endif
		//clear finished fields
		$icl['InventoryCountsLocation']['finished']=null;
		$icl['InventoryCountsLocation']['finished_id']=null;
		$this->InventoryCount->InventoryCountsLocation->save($icl);
		//delete itemCount records
		$this->InventoryCount->ItemCount->deleteAll(array('inventoryCount_id'=>$icl['InventoryCountsLocation']['inventoryCount_id'],'location_id'=>$icl['InventoryCountsLocation']['location_id']));
		$this->Session->setFlash(__('This location is marked for recount'));
		$this->redirect(array('action' => 'view',$icl['InventoryCountsLocation']['inventoryCount_id']));
	}
	
/**
* adjust mehod
* 
* @param $inventoryCountsLocation_id to post adjustments for
*/
	public function adjust($inventoryCountsLocation_id) {
		$this->set('formName','Post Adjustment');
		//validate
		$icl=$this->InventoryCount->InventoryCountsLocation->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$inventoryCountsLocation_id)));
		if(!$icl) {
			//invalid
			$this->Session->setFlash(__('The count could not be found'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if(!$icl['InventoryCountsLocation']['finished']) {
			//not finished
			$this->Session->setFlash(__('This location is not marked as finished'));
			$this->redirect(array('action' => 'index'));
		}//endif
		//build item list
		$items=array();
		$itemCounts=$this->InventoryCount->ItemCount->find('all',array('recursive'=>-1,'conditions'=>array('inventoryCount_id'=>$icl['InventoryCountsLocation']['inventoryCount_id'],'location_id'=>$icl['InventoryCountsLocation']['location_id'])));
		foreach($itemCounts as $itemCount) {
			//loop for all items counted and add to array
			$items[$itemCount['ItemCount']['item_id']]['cntQty']=$itemCount['ItemCount']['qty'];
			$items[$itemCount['ItemCount']['item_id']]['curQty']=0;
		}//end foreach itemCounts
		$itemsLocations=$this->InventoryCount->Location->ItemsLocation->find('all',array('conditions'=>array('location_id'=>$icl['InventoryCountsLocation']['location_id'])));
		foreach($itemsLocations as $il) {
			//loop for all existing qtys at location and add to item array
			if(!isset($items[$il['ItemsLocation']['item_id']]['cntQty']))$items[$il['ItemsLocation']['item_id']]['cntQty']=0;
			$items[$il['ItemsLocation']['item_id']]['curQty']=$il['ItemsLocation']['qty'];
			$items[$il['ItemsLocation']['item_id']]['items_locations_id']=$il['ItemsLocation']['id'];
		}//end foreach itemsLocations
		//build array
		foreach($items as $item_id=>$item) {
			//loop for all items
			if($item['cntQty']==$item['curQty']) {
				//no need to procede if there is no difference
				unset($items[$item_id]);
			} else {
				//qtys no not match
				$items[$item_id]['difference']=intval($item['cntQty'])-intval($item['curQty']);
				$items[$item_id]['name']=$this->InventoryCount->ItemCount->Item->field('name',array('id'=>$item_id));
				$items[$item_id]['serialized']=$this->InventoryCount->ItemCount->Item->field('serialized',array('id'=>$item_id));
				if($items[$item_id]['serialized'] && $items[$item_id]['difference']<0) {
					//get serial numbers for items at location
					$items[$item_id]['serialNumbers']=ClassRegistry::init('ItemSerialNumber')->find('list',array('fields'=>array('number'),'conditions'=>array('item_id'=>$item_id,'item_location_id'=>$item['items_locations_id'])));
				}//endif
				if($items[$item_id]['difference']<0) {
					//get cost of item(s)
					$items[$item_id]['cost']=$this->ComputareIC->getCost($item_id,$items[$item_id]['difference']*-1);
				}//endif
			}//endif qtys differ
		}//end foreach items
		$this->set('items',$items);
		if ($this->request->is('post') || $this->request->is('put')) {
			//process request
			$ok=$fail=0;
			foreach($items as $item_id=> $item) {
				//loop for all items and post adjustments
				$adjust=array();
				if($this->request->data['InventoryCount']['notes']!='') $adjust['notes']=$this->request->data['InventoryCount']['notes'];
				$adjust['item_id']=$item_id;
				$adjust['qty']=$item['difference'];
				$adjust['location_id']=$icl['InventoryCountsLocation']['location_id'];
				$adjust['glAccount_id']=$this->request->data['InventoryCount']['glAccount_id'];
				if($item['difference']>0) {
					//+ qty
					$adjust['cost']=$this->request->data['InventoryCount'][$item_id]['cost'];
					$adjust['vendor_id']=$this->request->data['InventoryCount'][$item_id]['vendor_id'];
				} else {
					//- qty
				}//endif
				if($this->ComputareIC->adjust($adjust)) $ok++;
				else $fail++;
			}//end foreach
			if($fail==0) {
				//ok
				$this->Session->setFlash(__($ok.' Adjustments have been posted'),'default',array('class'=>'success'));
				$this->redirect(array('action'=>'view',$icl['InventoryCountsLocation']['inventoryCount_id']));
			} else {
				//problems
				$this->Session->setFlash(__($ok.' Adjustments have been posted, '.$fail.' did not post.'));
			}//endif
			
// debug($this->request->data);debug($items);exit;
		} else {
			//get defaults
//			$this->request->data['InventoryCount']['glAccount_id']=$this->ComputareGL->getSlot('issuecredit');
		}//endif
		//get basic data
		$this->set('location_id',$icl['InventoryCountsLocation']['location_id']);
		$this->set('locationName',$this->InventoryCount->Location->field('name',array('id'=>$icl['InventoryCountsLocation']['location_id'])));
		$this->set('finished',$icl['InventoryCountsLocation']['finished']);
		$this->set('by',ClassRegistry::init('User')->field('username',array('id'=>$icl['InventoryCountsLocation']['finished_id'])));
		$this->set('vendors',ClassRegistry::init('Vendor')->find('list'));
		$this->set('glAccounts',ClassRegistry::init('Glaccount')->find('list'));
	}
	
/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->InventoryCount->id = $id;
		if (!$this->InventoryCount->exists()) {
			throw new NotFoundException(__('Invalid inventory count'));
		}
		if ($this->InventoryCount->delete()) {
			$this->Session->setFlash(__('Inventory count deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inventory count was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
