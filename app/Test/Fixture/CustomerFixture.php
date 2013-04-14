<?php
/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'customerDetail_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'deleted_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'customerDetail_id' => array('column' => 'customerDetail_id', 'unique' => 0)
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
			'customerDetail_id' => 1,
			'active' => 1,
			'created' => '2013-04-12 10:31:35',
			'created_id' => 1,
			'modified' => '',
			'deleted_id' => 0
		),
		array(
			'id' => 2,
			'customerDetail_id' => 1,
			'active' => 0,
			'created' => '2013-04-12 10:31:35',
			'created_id' => 1,
			'modified' => '2013-04-12 10:31:35',
			'deleted_id' => 1
		),
	);

}
