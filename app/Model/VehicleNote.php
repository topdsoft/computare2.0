<?php
App::uses('AppModel', 'Model');
/**
 * VehicleNote Model
 *
 * @property Vehicle $Vehicle
 */
class VehicleNote extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'vehicleNotes';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'note' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Vehicle' => array(
			'className' => 'Vehicle',
			'foreignKey' => 'vehicle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
