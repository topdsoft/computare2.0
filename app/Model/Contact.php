<?php
App::uses('AppModel', 'Model');
/**
 * Contacts Model
 *
 */
class Contact extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'field_name';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Customer' => array(
			"className"=>'Customer'
		),
		'Vendor' => array(
			'className'=>'Vendor'
		)
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'field_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a field name here (EX: Phone Number)',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter contact info here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
