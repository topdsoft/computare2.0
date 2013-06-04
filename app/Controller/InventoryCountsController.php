<?php
App::uses('AppController', 'Controller');
/**
 * InventoryCounts Controller
 *
 * @property InventoryCount $InventoryCount
 */
class InventoryCountsController extends AppController {

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
