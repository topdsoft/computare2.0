<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrderFee Model
 *
 * @property SalesOrderType $SalesOrderType
 */
class SalesOrderFee extends AppModel {

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
	public $useTable = 'salesOrderFees';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'label';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'label' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Enter a Label Here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'SalesOrderType' => array(
			'className' => 'SalesOrderType',
			'foreignKey' => 'salesOrderType_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
