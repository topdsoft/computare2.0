<?php
App::uses('AppModel', 'Model');
/**
 * VehicleVisit Model
 *
 * @property Vehicle $Vehicle
 */
class VehicleVisit extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'vehicleVisits';


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
