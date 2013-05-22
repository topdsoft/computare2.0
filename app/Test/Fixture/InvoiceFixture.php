<?php
/**
 * InvoiceFixture
 *
 */
class InvoiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'closed' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'closed_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'customer_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'vendor_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'purchaseOrder_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'salesOrder_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'customer_id' => array('column' => 'customer_id', 'unique' => 0),
			'vendor_id' => array('column' => 'vendor_id', 'unique' => 0),
			'purchaseOrder_id' => array('column' => 'purchaseOrder_id', 'unique' => 0),
			'salesOrder_id' => array('column' => 'salesOrder_id', 'unique' => 0)
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
			'created' => '2013-05-22 11:15:11',
			'created_id' => 1,
			'closed' => '2013-05-22 11:15:11',
			'closed_id' => 1,
			'status' => 'Lorem ipsum dolor sit ame',
			'customer_id' => 1,
			'vendor_id' => 1,
			'purchaseOrder_id' => 1,
			'salesOrder_id' => 1
		),
	);

}
