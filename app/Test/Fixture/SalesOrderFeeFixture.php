<?php
/**
 * SalesOrderFeeFixture
 *
 */
class SalesOrderFeeFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'salesOrderFees';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'salesOrderType_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'label' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'debitAccount_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'creditAccount_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
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
			'created' => '2014-02-25 14:17:52',
			'created_id' => 1,
			'salesOrderType_id' => 1,
			'label' => 'Lorem ipsum dolor sit amet',
			'debitAccount_id' => 1,
			'creditAccount_id' => 1
		),
	);

}
