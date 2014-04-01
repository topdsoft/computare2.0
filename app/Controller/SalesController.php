<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 */
class SalesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Sales');
		$this->set('add_menu',true);
		$users=ClassRegistry::init('User')->find('list');
		//setup filters to use
		$filter=array();
		//date filter
		$filter[]=array('type'=>3,'passName'=>'created','label'=>'Date','field'=>'Sale.created');
		//user filter
		$filter[]=array('type'=>1,'passName'=>'user','label'=>'User','field'=>'Sale.created_id','options'=>$users);
		//qty filter
		$filter[]=array('type'=>2,'passName'=>'qty','label'=>'Qty','field'=>'SalesOrderDetail.qty');
		//price filter
		$filter[]=array('type'=>2,'passName'=>'price','label'=>'Price','field'=>'SalesOrderDetail.price');
		//SO filter
		$filter[]=array('type'=>2,'passName'=>'so','label'=>'SO','field'=>'SalesOrderDetail.salesOrder_id');
		//customer filter
		$options=$this->Sale->Customer->find('list');
		$filter[]=array('type'=>1,'passName'=>'cust','label'=>'Customer','options'=>$options,'field'=>'Sale.customer_id');
		$this->_useFilter($filter);
		$this->Sale->recursive = 0;
		$this->set('sales', $this->paginate('Sale',$this->conditions));
		$this->set('users',$users);
		$this->set('fullQtyTotal',0);
		$this->set('fullTotal',0);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Sale');
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$this->set('sale', $this->Sale->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

}
