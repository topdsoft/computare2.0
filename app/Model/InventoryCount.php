<?php
App::uses('AppModel', 'Model');
/**
 * InventoryCount Model
 *
 * @property ItemCount $ItemCount
 * @property Location $Location
 */
class InventoryCount extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'inventoryCounts';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ItemCount' => array(
			'className' => 'ItemCount',
			'foreignKey' => 'inventoryCount_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Location' => array(
			'className' => 'Location',
			'joinTable' => 'inventoryCounts_locations',
			'foreignKey' => 'inventoryCount_id',
			'associationForeignKey' => 'location_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
