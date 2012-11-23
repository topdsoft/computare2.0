<?php
App::uses('AppModel', 'Model');
/**
 * Glcheck Model
 *
 */
class Glcheck extends AppModel {

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
		'checkNumber' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The check number must be a number',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
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
}
