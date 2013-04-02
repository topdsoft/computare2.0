<?php
App::uses('AppModel', 'Model');
/**
 * PurchaseOrder Model
 *
 * @property Vendor $Vendor
 * @property PurchaseOrderDetail $PurchaseOrderDetail
 */
class PurchaseOrder extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'purchaseOrders';
	public $virtualFields = array(
		'lines'=>'select count(*) from purchaseOrderDetails where purchaseOrderDetails.purchaseOrder_id=PurchaseOrder.id and purchaseOrderDetails.active',
		'rec'=>'select sum(rec) from purchaseOrderDetails where purchaseOrderDetails.purchaseOrder_id=PurchaseOrder.id'
	);
	public $order = array('PurchaseOrder.created'=>'desc');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PurchaseOrderDetail' => array(
			'className' => 'PurchaseOrderDetail',
			'foreignKey' => 'purchaseOrder_id',
			'dependent' => false,
			'conditions' => 'PurchaseOrderDetail.active',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
