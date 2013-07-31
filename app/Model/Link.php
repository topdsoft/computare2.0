<?php
App::uses('AppModel', 'Model');
/**
 * Link Model
 *
 * @property WorkflowChain $WorkflowChain
 */
class Link extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'form' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ordr' => array(
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
		'WorkflowChain' => array(
			'className' => 'WorkflowChain',
			'foreignKey' => 'workflowChain_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
