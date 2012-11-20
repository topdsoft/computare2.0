<?php
App::uses('AppModel', 'Model');
/**
 * Glaccountdetail Model
 *
 * @property Glaccount $Glaccount
 * @property Glgroup $Glgroup
 */
class GlaccountDetail extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

	public $useTable='glaccountDetails';
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
				'message' => 'Enter an account name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isunique'),
				'message' => 'This account name has been used',
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
		'Glaccount' => array(
			'className' => 'Glaccount',
			'foreignKey' => 'glaccount_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Glgroup' => array(
			'className' => 'Glgroup',
			'foreignKey' => 'glgroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
