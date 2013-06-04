<?php
App::uses('AppModel', 'Model');
/**
 * ItemCount Model
 *
 * @property Item $Item
 * @property InventoryCount $InventoryCount
 * @property Location $Location
 */
class ItemCount extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'itemCounts';


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
		'InventoryCount' => array(
			'className' => 'InventoryCount',
			'foreignKey' => 'inventoryCount_id',
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
		)
	);
}
