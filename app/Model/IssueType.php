<?php
App::uses('AppModel', 'Model');
/**
 * IssueType Model
 *
 * @property GlAccount $GlAccount
 */
class IssueType extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'issueTypes';

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
			'foreignKey' => 'glAccount_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
