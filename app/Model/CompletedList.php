<?php
App::uses('AppModel', 'Model');
/**
 * CompletedList Model
 *
 * @property ListTemplate $ListTemplate
 * @property Customer $Customer
 * @property PurchaseOrder $PurchaseOrder
 * @property SalesOrder $SalesOrder
 * @property Item $Item
 */
class CompletedList extends AppModel {

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
	public $useTable = 'completedLists';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ListTemplate' => array(
			'className' => 'ListTemplate',
			'foreignKey' => 'listTemplate_id',
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
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
