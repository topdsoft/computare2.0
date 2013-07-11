<?php
/**
 * ScanCodeFixture
 *
 */
class ScanCodeFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'scanCodes';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 18, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'item_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'location_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'itemSerialNumber_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'print' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'internal' => array('type' => 'boolean', 'null' => false, 'default' => null),
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
			'created' => '2013-07-11 13:24:05',
			'created_id' => 1,
			'code' => 'Lorem ipsum dolo',
			'item_id' => 1,
			'location_id' => 1,
			'itemSerialNumber_id' => 1,
			'user_id' => 1,
			'print' => 1,
			'internal' => 1
		),
	);

}
