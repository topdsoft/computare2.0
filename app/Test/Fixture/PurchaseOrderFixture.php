<?php
/**
 * PurchaseOrderFixture
 *
 */
class PurchaseOrderFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'purchaseOrders';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'vendor_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'allowOpen' => array('type' => 'boolean', 'null' => false, 'default' => null),
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
			'created' => '2013-03-27 15:17:58',
			'created_id' => 1,
			'vendor_id' => 1,
			'status' => 'Lorem ipsum dolor sit ame',
			'allowOpen' => 1
		),
	);

}
