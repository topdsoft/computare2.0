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
		'customerDetail_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'created_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'deleted_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => true),
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
			'customerDetail_id' => 1
		),
	);

}
