<?php
App::uses('AppModel', 'Model');
/**
 * Glgroup Model
 *
 * @property Glaccountdetail $Glaccountdetail
 */
class Glgroup extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

	public $virtualFields=array('numAccounts'=>'select count(*) from glaccounts,glaccountDetails where glaccounts.id=glaccountDetails.glaccount_id and glaccountDetails.glgroup_id=Glgroup.id',
		);
	
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
			'notblank' => array(
				'rule' => array('notblank'),
				'message' => 'Please enter a name for the General Ledger group',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isunique'),
				'message' => 'This name is in use',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'GlaccountDetail' => array(
			'className' => 'GlaccountDetail',
			'foreignKey' => 'glgroup_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
