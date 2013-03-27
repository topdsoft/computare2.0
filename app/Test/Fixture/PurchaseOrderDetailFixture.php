<?php
/**
 * PurchaseOrderDetailFixture
 *
 */
class PurchaseOrderDetailFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'purchaseOrderDetails';

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
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => null),
		'shipped' => array('type' => 'integer', 'null' => false, 'default' => null),
		'price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '12,2'),
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
			'created' => '2013-03-26 15:59:55',
			'created_id' => 1,
			'salesOrder_id' => 1,
			'item_id' => 1,
			'qty' => 1,
			'shipped' => 1,
			'price' => 1
		),
	);

}
