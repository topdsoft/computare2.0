<?php
/**
 * SalesOrderModFixture
 *
 */
class SalesOrderModFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'salesOrderMods';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'salesOrder_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'invoiced' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'label' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '12,2'),
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
			'created' => '2014-02-25 14:19:07',
			'created_id' => 1,
			'salesOrder_id' => 1,
			'invoiced' => 1,
			'label' => 'Lorem ipsum dolor sit amet',
			'amount' => 1
		),
	);

}
