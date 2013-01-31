<?php
/**
 * PermissioneventFixture
 *
 */
class PermissioneventFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'controller' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'form_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'note' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'created' => '2013-01-31 11:47:42',
			'created_id' => 1,
			'user_id' => 1,
			'group_id' => 1,
			'controller' => 'Lorem ipsum dolor ',
			'form_id' => 1,
			'note' => 'Lorem ipsum dolor '
		),
	);

}
