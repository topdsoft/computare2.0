<?php
/**
 * SaleFixture
 *
 */
class SaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'item_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'service_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'salesOrderDetail_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
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
			'created' => '2014-02-25 14:16:02',
			'created_id' => 1,
			'item_id' => 1,
			'service_id' => 1,
			'salesOrderDetail_id' => 1,
			'customer_id' => 1
		),
	);

}
