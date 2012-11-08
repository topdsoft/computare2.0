<?php
App::uses('AppModel', 'Model');
/**
 * Glentry Model
 *
 * @property Glaccount $Glaccount
 * @property Glcheck $Glcheck
 */
class Glentry extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'debit' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'credit' => array(
			'decimal' => array(
				'rule' => array('decimal'),
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
		'Glcheck' => array(
			'className' => 'Glcheck',
			'foreignKey' => 'glcheck_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
