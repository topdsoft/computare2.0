<?php
/**
 * ContactFixture
 *
 */
class ContactFixture extends CakeTestFixture {

// 	public $table='contacts';
/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'deleted' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'deleted_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'field_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'vendor_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'vendor_id' => array('column' => 'vendor_id', 'unique' => 0),
			'customer_id' => array('column' => 'customer_id', 'unique' => 0)
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
			'created' => '2013-04-12 10:13:52',
			'created_id' => 1,
			'field_name' => 'Email',
			'value' => 'add@me.net',
			'vendor_id' => 0,
			'customer_id' => 1,
			'active' => 1
		),
		array(
			'id' => 2,
			'created' => '2013-04-12 10:13:52',
			'created_id' => 1,
			'field_name' => 'Email',
			'value' => 'name@some.com',
			'vendor_id' => 1,
			'customer_id' => 0,
			'active' => 1
		),
	);

}
