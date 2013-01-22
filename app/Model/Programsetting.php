<?php
App::uses('AppModel', 'Model');
/**
 * Programsetting Model
 *
 */
class Programsetting extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';
	public $order = 'id desc';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'full_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter company name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
