<?php
/**
 * CustomerGroupsItemFixture
 *
 */
class CustomerGroupsItemFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'customerGroups_items';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'customerGroup_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '12,2'),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'qty' => array('column' => 'qty', 'unique' => 0),
			'item_id' => array('column' => 'item_id', 'unique' => 0),
			'customerGroup_id' => array('column' => 'customerGroup_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'item_id' => 1,
			'customerGroup_id' => 1,
			'active' => 1,
			'price' => 1,
			'qty' => 1
		),
	);

}
