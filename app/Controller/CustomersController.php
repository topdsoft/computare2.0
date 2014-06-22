<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {

	
	public $components=array('ComputareCustomer','ComputareAR');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Customers');
		$this->set('helplink','/pages/customers#lc');
		$this->set('add_menu',true);
		//get customerGroups
		$groups=$this->Customer->CustomerGroup->find('list');
		//use filters
		$filters=array();
		if($groups){
			//only add groups filter if there are groups defined
			$filters[]=array(
				'type'=>1,
				'label'=>'Group',
				'field'=>'Customer.customerGroup_id',
				'options'=>$groups,
				'passName'=>'group'
			);
		}//endif
		$filters[]=array('type'=>4,
			'label'=>'Show Deleted Customers',
			'falseCondition'=>'Customer.active',
			'falseMessage'=>'',
			'trueCondition'=>'',
			'trueMessage'=>'Showing deleted customers',
			'passName'=>'showDeleted'
		);
		$this->_useFilter($filters);
		$this->Customer->recursive = 0;
		$this->set('customers', $this->paginate('Customer',$this->conditions));
		//setup actions block
		$this->_addActionsLink(__('New Customer'), array('action' => 'add'));
		$this->_addActionsLink(__('List Customer Groups'), array('controller' => 'customerGroups', 'action' => 'index'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Customer');
		$this->set('helplink','/pages/customers#v');
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->Customer->bindModel(array('hasMany'=>array('Revisions'=>array(
			'className'=>'CustomerDetail',
			'order'=>'Revisions.id desc'))));
		$this->Customer->recursive = 2;
		$this->set('customer', $this->Customer->read(null, $id));
		//get users list for showing created and deleted id
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('users'));
		//setup actions block
		$this->_addActionsLink(__('Edit Customer'), array('action' => 'edit', $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//adding customer uses the edit function with null id
		$this->set('formName','Add New Customer');
		$this->set('add_menu',true);
		$this->passedArgs+=array('action'=>'edit');
		$this->redirect($this->passedArgs);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Customer');
		$this->set('helplink','/pages/customers#ec');
		//if $id not set we are adding a new customer
		if($id) {
			//validate $id
			$this->Customer->id = $id;
			if (!$this->Customer->exists()) {
				throw new NotFoundException(__('Invalid customer'));
			}
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
		//save data
			$this->request->data['CustomerDetail']['created_id']=$this->Auth->user('id');
			if ($this->ComputareCustomer->save($this->request->data)){
				$this->Session->setFlash(__('The customer has been saved'),'default',array('class'=>'success'));
				//check for redirect
				if(isset($this->passedArgs['redirect'])) {
					//will redirect-check special cases
					if($this->passedArgs['redirect']['controller']=='salesOrders' && $this->passedArgs['redirect']['action']=='add') {
						//add new customer_id
						$this->passedArgs['redirect']['customer_id']=$this->Customer->getInsertId();
					}//endif
					$this->redirect($this->passedArgs['redirect']);
				}//endif
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
			}
		} else {
			//not saving
			if($id) {
				//editing
				$this->request->data = $this->Customer->read(null, $id);
				$this->set('action','Edit');
			} else {
				//new customer
				$this->request->data['CustomerDetail'] = $this->passedArgs;
				$this->set('action','Add');
			}//endif
		}
		$customerGroups=array(null=>'(none)')+$this->Customer->CustomerGroup->find('list');
		$this->set(compact('customerGroups'));
	}

/**
 * editPricing method
 * @param int $id
 */
	public function editPricing($id=null) {
		$this->set('formName','Edit Pricing');
		$this->set('helplink','/pages/customers#lcp');
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(isset($this->request->data['Item']['item_id']) && $this->request->data['Item']['price']!='') {
				//modify format of data from new item
				$item_id=$this->request->data['Item']['item_id'];
				$this->request->data['Item'][$item_id][0]=array('price'=>$this->request->data['Item']['price'],'qty'=>'0','id'=>'');
				unset($item_id);
			}//endif
			unset($this->request->data['Item']['item_id'],$this->request->data['Item']['price']);
			$ok=true;
			foreach($this->request->data['Item'] as $item_id => $p) {
				//loop for each different item
				$priceData=array('Item'=>array('id'=>$item_id),'Customer'=>array($id=>$p));
				if($ok)$ok=$this->ComputareAR->setItemPrice($priceData);
// debug($priceData);//exit;
				
			}//end foreach
// debug($this->request->data);exit;
			if ($ok) {
				$this->Session->setFlash(__('The item price has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
			
		} else {
// 			$this->Customer->bindModel(array('hasAndBelongsToMany'=>array('Item'=>array(
// 				'className'=>'Item',
// 				'joinTable'=>'customers_items',
// 				'foreignKey' => 'customer_id',
// 				'associationForeignKey' => 'item_id',
// 				'unique' => 'keepExisting',
// 				'conditions' => 'CustomersItem.active',
// 				'order'=>'item_id,qty'
// 			))));
			$this->request->data = $this->Customer->read(null, $id);
			//get pricing data
			$this->CustomersItem=ClassRegistry::init('CustomersItem');
			$this->CustomersItem->bindModel(array('belongsTo'=>array('Item'=>array('fields'=>array('name','id')))));
			$pricingData=$this->CustomersItem->find('all',array('conditions'=>array('CustomersItem.active','customer_id'=>$id),'order'=>'item_id,qty'));
			$this->request->data['Item']=array();
			$activeItems=array();
			foreach($pricingData as $p){
				//loop for all price points
				$this->request->data['Item'][$p['Item']['id']][]=array(
					'name'=>$p['Item']['name'],
					'id'=>$p['CustomersItem']['id'],
					'qty'=>$p['CustomersItem']['qty'],
					'price'=>$p['CustomersItem']['price']
				);
				$activeItems[$p['Item']['id']]=$p['Item']['id'];
			}//end foreach
// debug($pricingData);exit;
		}
		$this->Session->setFlash(__('Changes made on this form are not saved until you click Submit'),'default',array('class'=>'notice'));
		$this->set('items',ClassRegistry::init('Item')->find('list',array('conditions'=>array('NOT'=>array('Item.id'=>$activeItems)))));
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
		$this->set('formName','Remove Customer');
		$this->set('helplink','/pages/customers#dc');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->ComputareCustomer->delete($id,$this->Auth->user('id'))) {
			$this->Session->setFlash(__('Customer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Customer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
