<?php
App::uses('AppModel', 'Model');
/**
 * Glaccountdetail Model
 *
 * @property Glaccount $Glaccount
 * @property Glgroup $Glgroup
 */
class Glaccountdetail extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

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
