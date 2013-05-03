<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrderDetail Model
 *
 * @property SalesOrder $SalesOrder
 * @property Item $Item
 * @property Service $Service
 */
class SalesOrderDetail extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'salesOrderDetails';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'qty' => array(
			'comparison' => array(
				'rule' => array('comparison','>',0),
				'message' => 'Please enter a qty greather than 0 here',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
		),
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'service_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
