<?php
/**
 * SalesOrderTypeFixture
 *
 */
class SalesOrderTypeFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'salesOrderTypes';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'removed' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'removed_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'shipping' => array('type' => 'boolean', 'null' => false, 'default' => null),
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
			'created' => '2013-04-13 15:35:45',
			'created_id' => 1,
			'removed' => '',
			'removed_id' => 0,
			'active' => 1,
			'name' => 'Type0',
			'shipping' => 1
		),
		array(
			'id' => 2,
			'created' => '2013-04-13 15:35:45',
			'created_id' => 1,
			'removed' => '2013-04-13 15:35:45',
			'removed_id' => 1,
			'active' => 0,
			'name' => 'Type1',
			'shipping' => 2
		),
	);

}
