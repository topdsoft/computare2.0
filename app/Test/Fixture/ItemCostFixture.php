<?php
/**
 * ItemCostFixture
 *
 */
class ItemCostFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'itemCosts';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'vendor_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'cost' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'created' => '2013-03-26 15:43:47',
			'created_id' => 1,
			'item_id' => 1,
			'vendor_id' => 1,
			'cost' => 1
		),
	);

}
