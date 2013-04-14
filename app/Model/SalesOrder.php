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


	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
}
