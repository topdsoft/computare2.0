<?php
App::uses('AppModel', 'Model');
/**
 * Invoice Model
 *
 * @property Customer $Customer
 * @property Vendor $Vendor
 * @property PurchaseOrder $PurchaseOrder
 * @property SalesOrder $SalesOrder
 * @property InvoiceDetail $InvoiceDetail
 */
class Invoice extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PurchaseOrder' => array(
			'className' => 'PurchaseOrder',
			'foreignKey' => 'purchaseOrder_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SalesOrder' => array(
			'className' => 'SalesOrder',
			'foreignKey' => 'salesOrder_id',
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
		'InvoiceDetail' => array(
			'className' => 'InvoiceDetail',
			'foreignKey' => 'invoice_id',
			'dependent' => false,
			'conditions' => '',
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
