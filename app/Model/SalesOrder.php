<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrder Model
 *
 * @property SalesOrderType $SalesOrderType
 * @property Customer $Customer
 */
class SalesOrder extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'salesOrders';
	public $order='SalesOrder.id desc';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check table schema and make adjustments if necessary
		$dbs=$this->getSechema();
		$ok=true;
		if($ok && $dbs<1) {
			//add shipping_paid field
			try {$this->query('ALTER TABLE  `salesOrders` ADD  `shipping_paid` FLOAT( 12, 2 ) NULL');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(1);
			else $this->logDBFailure($e);
		}//endif dbs<1
	}

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SalesOrderType' => array(
			'className' => 'SalesOrderType',
			'foreignKey' => 'SalesOrderType_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'ItemDetail' => array(
			'className' => 'SalesOrderDetail',
			'foreignKey' => 'salesOrder_id',
			'conditions' => array('ItemDetail.active','ItemDetail.item_id')
		),
		'ServiceDetail' => array(
			'className' => 'SalesOrderDetail',
			'foreignKey' => 'salesOrder_id',
			'conditions' => array('ServiceDetail.active','ServiceDetail.service_id')
		),
		/*'SalesOrderMod',*/
	);
}
