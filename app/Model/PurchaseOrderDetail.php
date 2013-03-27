<?php
App::uses('AppModel', 'Model');
/**
 * PurchaseOrderDetail Model
 *
 * @property PurchaseOrder $PurchaseOrder
 * @property Item $Item
 */
class PurchaseOrderDetail extends AppModel {

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
	public $useTable = 'purchaseOrderDetails';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'qty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rec' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
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
		'PurchaseOrder' => array(
			'className' => 'PurchaseOrder',
			'foreignKey' => 'purchaseOrder_id',
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
