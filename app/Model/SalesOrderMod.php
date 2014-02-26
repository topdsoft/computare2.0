<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrderMod Model
 *
 * @property SalesOrder $SalesOrder
 */
class SalesOrderMod extends AppModel {

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
	public $useTable = 'salesOrderMods';


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
		)
	);
}
