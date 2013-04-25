<?php
App::uses('AppModel', 'Model');
/**
 * CustomerGroup Model
 *
 * @property Item $Item
 * @property Service $Service
 */
class CustomerGroup extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'customerGroups';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $virtualFields=array(
		'numCustomers'=>'select count(*) from customers where customers.customerGroup_id=CustomerGroup.id'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a customer group name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'This name has been used',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * hasMany
 */
	public $hasMany = array(
		'Customer'=>array(
			'className'=>'Customer',
			'conditions'=>'Customer.active'
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Item' => array(
			'className' => 'Item',
			'joinTable' => 'customerGroups_items',
			'foreignKey' => 'customerGroup_id',
			'associationForeignKey' => 'item_id',
			'unique' => 'keepExisting',
			'conditions' => 'CustomerGroupsItem.active',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Service' => array(
			'className' => 'Service',
			'joinTable' => 'customerGroups_services',
			'foreignKey' => 'customerGroup_id',
			'associationForeignKey' => 'service_id',
			'unique' => 'keepExisting',
			'conditions' => 'CustomerGroupsService.active',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
