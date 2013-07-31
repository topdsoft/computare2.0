<?php
App::uses('AppModel', 'Model');
/**
 * WorkflowChain Model
 *
 * @property Link $Link
 */
class WorkflowChain extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'workflowChains';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
/*		'return_form' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'workflowChain_id',
			'dependent' => false,
			'conditions' => 'Link.active',
			'fields' => '',
			'order' => 'ordr',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
