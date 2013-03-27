<?php
/**
 * ItemTransactionFixture
 *
 */
class ItemTransactionFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'itemTransactions';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'sale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'receipt_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => null),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'created' => '2013-03-26 15:45:48',
			'created_id' => 1,
			'item_id' => 1,
			'sale_id' => 1,
			'receipt_id' => 1,
			'qty' => 1,
			'type' => 'Lorem ipsum dolor sit ame'
		),
	);

}
