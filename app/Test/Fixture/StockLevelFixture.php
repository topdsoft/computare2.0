<?php
/**
 * StockLevelFixture
 *
 */
class StockLevelFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'stockLevels';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'removed' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'removed_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'location_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => null),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'location_id' => array('column' => 'location_id', 'unique' => 0),
			'item_id' => array('column' => 'item_id', 'unique' => 0)
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
			'created' => '2013-06-07 08:45:59',
			'created_id' => 1,
			'removed' => '2013-06-07 08:45:59',
			'removed_id' => 1,
			'active' => 1,
			'location_id' => 1,
			'item_id' => 1,
			'qty' => 1,
			'priority' => 1
		),
	);

}
