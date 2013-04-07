<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {

	public $components=array('ComputareIC');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Items');
		$this->Item->recursive = 0;
		$items=$this->paginate();
		foreach($items as $i=>$item) $items[$i]['path']=$this->Item->ItemCategory->getPath($item['Item']['category_id'],array('id','name'));
//  debug($items);exit;
		$this->set(compact('items'));
	}
//$this->Item->Location->reorder(array('order'=>'asc','field'=>'name','id'=>3));

/**
 * bylocation method
 */
	public function bylocation() {
		$this->set('formName','List Items By Location');
		//create new assoications
		$this->Item->ItemsLocation->bindModel(
			array('belongsTo' => array(
				'Item' => array(
					'className'=>'Item',
					'fields'=>array('name')
					),
				'Location' => array(
					'className'=>'Location',
					'fields'=>array('name','lft')
					)
				)
				
			)
		);
		$this->paginate = array('order'=>'lft');
		$items=$this->paginate('ItemsLocation'); 
//		$itemsList=$this->Item->find('list');
//		$locationsList=$this->Item->Location->find('list');
		//get path
		foreach($items as $i=>$item) $items[$i]['path']=$this->Item->Location->getPath($item['ItemsLocation']['location_id'],array('id','name'));
//  debug($items);exit;
		$this->set(compact('items'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','Item Details');
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->set('item', $this->Item->read(null, $id));
		$this->set('users', ClassRegistry::init('User')->find('list'));
		$this->set('locations', $this->Item->Location->find('list'));
		$this->set('vendors', $this->Item->Vendor->find('list'));
		$cats=$this->Item->ItemCategory->find('list');
		$cats[0]='';
		$this->set('categories', $cats);
		$this->set('itemlocations',$this->Item->ItemsLocation->find('list',array('fields'=>array('location_id'))));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Item'); 
		//editing item
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareIC->saveItem($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			//default
			$this->request->data['Item']['category_id']=0;
		}
		$categories = $this->Item->ItemCategory->generateTreeList(null,null,null,' - ');
		if($categories) $categories[0]='(none)';
		$itemGroups = $this->Item->ItemGroup->find('list');
// 		$images = $this->Item->Image->find('list');
// 		$locations = $this->Item->Location->find('list');
// 		$vendors = $this->Item->Vendor->find('list');
		$this->set(compact('categories', 'itemGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Item'); 
		//editing item
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareIC->saveItem($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
		}
		$categories = $this->Item->ItemCategory->generateTreeList(null,null,null,' - ');
		if($categories) $categories[0]='(none)';
		$itemGroups = $this->Item->ItemGroup->find('list');
// 		$images = $this->Item->Image->find('list');
// 		$locations = $this->Item->Location->find('list');
// 		$vendors = $this->Item->Vendor->find('list');
		$this->set(compact('categories', 'itemGroups'));
	}

/**
 * receive method
 * @param int $id
 * @param int $location_id (default, can be changed)
 */
	public function receive($id = null, $location_id = null) {
		$this->set('formName','Receive Item');
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			$data['item_id']=$id;
			$data['cost']=$this->request->data['Item']['cost'];
			if(isset($this->request->data['Item']['qty'])) $data['qty']=$this->request->data['Item']['qty'];
			else $data['qty']=1;
			$data['location_id']=$this->request->data['Item']['location_id'];
			$data['purchaseOrder_id']=$this->request->data['Item']['purchaseOrder_id'];
			if(isset($this->request->data['ItemSerialNumber'])) {
				//item is serialized
				$data['number']=$this->request->data['ItemSerialNumber']['number'];
			}//endif
			if($this->ComputareIC->receive($data)) {
				//success
				$this->Session->setFlash(__('The item has been received'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				//fail
				$this->Session->setFlash(__('The transaction could not be completed. Please, try again.'));
			}
		} else {
			//use defaults
			$this->request->data['Item']['location_id']=$location_id;
		}
		$this->set('item', $this->Item->read(null, $id));
		$this->set('locations', $this->Item->Location->generateTreeList(null,null,null,' - '));
		$this->set('purchaseOrders', ClassRegistry::init('PurchaseOrder')->find('list',array('conditions'=>array('PurchaseOrder.status'=>'O'))));
//$this->set('purchaseOrders', array(1=>1));
	}

/**
 * transfer method
 * @param int $id items_locations.id for item to be transferred
 * @param int $location_id where to transfer to (optional)
 */
	public function transfer($id=null, $location_id=null) {
		$this->set('formName','Transfer Item');
		//setup new assoications
		$this->Item->ItemsLocation->bindModel(
			array('belongsTo' => array(
				'Item' => array(
					'className'=>'Item',
					'fields'=>array('name','serialized')
					),
				'Location' => array(
					'className'=>'Location',
					'fields'=>array('name')
					)
				)
			)
		);
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			$data['item_location_id']=$id;
			if(isset($this->request->data['Item']['qty'])) $data['qty']=$this->request->data['Item']['qty'];
			$data['location_id']=$this->request->data['Item']['location_id'];
			if(isset($this->request->data['Item']['serialNumbers'])) $data['serialNumbers']=$this->request->data['Item']['serialNumbers'];
			if($this->ComputareIC->transfer($data)) {
				//success
				$this->Session->setFlash(__('The item has been transferred'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				//fail
				$this->Session->setFlash(__('The transfer could not be completed. Please, try again.'));
			}
		} else {
			//default
			$this->request->data['Item']['qty']=1;
		}//endif
		$itemLocation=$this->Item->ItemsLocation->read(null,$id);
		if(!$itemLocation) throw new NotFoundException(__('Invalid Item-Location'));
		$this->set('itemLocation',$itemLocation);
		if($itemLocation['Item']['serialized']) {
			//for serialized items get list of numbers
			$serialNumbers=$this->Item->ItemSerialNumber->find('list',array('fields'=>array('id','number') ,'conditions'=>array('item_location_id'=>$id)));
			$this->set('serialNumbers',$serialNumbers);
// debug($serialNumbers);exit;
		}//endif
// debug($itemLocation);exit;
		$this->set('locations', $this->Item->Location->generateTreeList(null,null,null,' - '));
	}

/**
 * issue method
 * @param int $id items_locations.id for item to be transferred
 */
	public function issue($id) {
		//issue inventory item
		$this->set('formName','Issue Item');
		//setup new assoications
		$this->Item->ItemsLocation->bindModel(
			array('belongsTo' => array(
				'Item' => array(
					'className'=>'Item',
					'fields'=>array('name','serialized')
					),
				'Location' => array(
					'className'=>'Location',
					'fields'=>array('name')
					)
				)
			)
		);
		if ($this->request->is('post') || $this->request->is('put')) {
debug($this->request->data);exit;
			if(isset($this->request->data['Item']['qty'])) $data['qty']=$this->request->data['Item']['qty'];
			$data['location_id']=$this->request->data['Item']['location_id'];
			if(isset($this->request->data['Item']['serialNumbers'])) $data['serialNumbers']=$this->request->data['Item']['serialNumbers'];
			if($this->ComputareIC->issue($data)) {
				//success
				$this->Session->setFlash(__('The item has been issued'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				//fail
				$this->Session->setFlash(__('The issue could not be completed. Please, try again.'));
			}
		} else {
			//default
			$this->request->data['Item']['qty']=1;
		}//endif
		$itemLocation=$this->Item->ItemsLocation->read(null,$id);
		if(!$itemLocation) throw new NotFoundException(__('Invalid Item-Location'));
		$this->set('itemLocation',$itemLocation);
		if($itemLocation['Item']['serialized']) {
			//for serialized items get list of numbers
			$serialNumbers=$this->Item->ItemSerialNumber->find('list',array('fields'=>array('id','number') ,'conditions'=>array('item_location_id'=>$id)));
			$this->set('serialNumbers',$serialNumbers);
// debug($serialNumbers);exit;
		}//endif
// debug($itemLocation);exit;
		
	}//end public function issue


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
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
