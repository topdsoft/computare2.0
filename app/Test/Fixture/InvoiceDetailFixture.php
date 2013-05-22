<?php
/**
 * InvoiceDetailFixture
 *
 */
class InvoiceDetailFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'invoiceDetails';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'invoice_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'removed' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'removed_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'text' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '12,2'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'invoice_id' => array('column' => 'invoice_id', 'unique' => 0)
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
			'invoice_id' => 1,
			'created' => '2013-05-22 11:15:42',
			'created_id' => 1,
			'removed' => '2013-05-22 11:15:42',
			'removed_id' => 1,
			'active' => 1,
			'text' => 'Lorem ipsum dolor sit amet',
			'amount' => 1
		),
	);

}
