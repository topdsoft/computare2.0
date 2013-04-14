<?php
/**
 * SalesOrderFixture
 *
 */
class SalesOrderFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'salesOrders';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'closed' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'closed_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'voided' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'voided_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'SalesOrderType_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
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
			'created' => '2013-04-13 15:38:45',
			'created_id' => 1,
			'closed' => '2013-04-13 15:38:45',
			'closed_id' => 1,
			'voided' => '2013-04-13 15:38:45',
			'voided_id' => 1,
			'status' => 'Lorem ipsum dolor sit ame',
			'SalesOrderType_id' => 1,
			'customer_id' => 1
		),
	);

}
