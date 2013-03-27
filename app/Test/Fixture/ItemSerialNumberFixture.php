<?php
/**
 * ItemSerialNumberFixture
 *
 */
class ItemSerialNumberFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'itemSerialNumbers';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'item_location_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'created' => '2013-03-26 15:44:57',
			'created_id' => 1,
			'item_location_id' => 1,
			'item_id' => 1,
			'number' => 'Lorem ipsum dolor sit amet'
		),
	);

}
