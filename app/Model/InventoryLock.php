<?php
App::uses('AppModel', 'Model');
/**
 * InventoryLock Model
 *
 * @property Location $Location
 */
class InventoryLock extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'inventoryLocks';
	public $order = 'InventoryLock.id desc';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
