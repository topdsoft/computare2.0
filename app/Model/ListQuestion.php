<?php
App::uses('AppModel', 'Model');
/**
 * ListQuestion Model
 *
 * @property ListTemplate $ListTemplate
 */
class ListQuestion extends AppModel {

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
	public $useTable = 'listQuestions';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'rank' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'label' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
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
		'ListTemplate' => array(
			'className' => 'ListTemplate',
			'foreignKey' => 'listTemplate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
