<?php
App::uses('AppModel', 'Model');
/**
 * CustomerGroupsItem Model
 *
 * @property Item $Item
 * @property CustomerGroup $CustomerGroup
 */
class CustomerGroupsItem extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'customerGroups_items';


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
		'CustomerGroup' => array(
			'className' => 'CustomerGroup',
			'foreignKey' => 'customerGroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
