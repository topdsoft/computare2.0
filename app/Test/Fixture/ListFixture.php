<?php
/**
 * ListFixture
 *
 */
class ListFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'listTemplate_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'purchaseOrder_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'salesOrder_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'listTemplate_id' => array('column' => 'listTemplate_id', 'unique' => 0),
			'customer_id' => array('column' => 'customer_id', 'unique' => 0),
			'purchaseOrder_id' => array('column' => 'purchaseOrder_id', 'unique' => 0),
			'salesOrder_id' => array('column' => 'salesOrder_id', 'unique' => 0),
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
			'created' => '2014-10-12 17:04:57',
			'created_id' => 1,
			'modified' => '2014-10-12 17:04:57',
			'modified_id' => 1,
			'listTemplate_id' => 1,
			'customer_id' => 1,
			'purchaseOrder_id' => 1,
			'salesOrder_id' => 1,
			'item_id' => 1
		),
	);

}
