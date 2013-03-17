<?php
/**
 * PermissionEventFixture
 *
 */
class PermissionEventFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'permissionEvents';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'userGroup_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'form_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'formGroup_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
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
			'created' => '2013-03-17 15:55:33',
			'created_id' => 1,
			'user_id' => 1,
			'userGroup_id' => 1,
			'form_id' => 1,
			'formGroup_id' => 1,
			'note' => 'Lorem ipsum dolor '
		),
	);

}
