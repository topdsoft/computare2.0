<?php
App::uses('AppModel', 'Model');
/**
 * Address Model
 *
 */
class Address extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

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
		'name' => array(
			'notblank' => array(
				'rule' => array('notblank'),
				'message' => 'Please enter a description here (EX: Shipping Address)',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'line1' => array(
			'notblank' => array(
				'rule' => array('notblank'),
				'message' => 'Please enter address here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notblank' => array(
				'rule' => array('notblank'),
				'message' => 'Please enter city here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state' => array(
			'notblank' => array(
				'rule' => array('notblank'),
				'message' => 'Please enter state here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'notblank' => array(
				'rule' => array('notblank'),
				'message' => 'Please enter zip code here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
