<?php
App::uses('AppModel', 'Model');
/**
 * FormGroup Model
 *
 * @property Form $Form
 */
class FormGroup extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'formGroups';
	public $order=array('name');

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
				'message' => 'Please enter a form group name here',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This Form Group Name has been taken',
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
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'formGroup_id',
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
