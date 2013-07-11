<?php
App::uses('AppModel', 'Model');
/**
 * ScanCode Model
 *
 * @property Item $Item
 * @property Location $Location
 * @property ItemSerialNumber $ItemSerialNumber
 * @property User $User
 */
class ScanCode extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'scanCodes';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter your scancode here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule'=>array('isUnique'),
				'message'=>'This Code is allready in the system',
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
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ItemSerialNumber' => array(
			'className' => 'ItemSerialNumber',
			'foreignKey' => 'itemSerialNumber_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
