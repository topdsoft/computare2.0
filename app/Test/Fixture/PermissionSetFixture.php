<?php
/**
 * PermissionSetFixture
 *
 */
class PermissionSetFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'permissionSets';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'userGroup_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'form_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'formGroup_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'view' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'submit' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'setDefault' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'setLogging' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'undoOwn' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'undoOthers' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'userGroup_id' => array('column' => 'userGroup_id', 'unique' => 0),
			'form_id' => array('column' => 'form_id', 'unique' => 0),
			'formGroup_id' => array('column' => 'formGroup_id', 'unique' => 0)
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
			'created' => '2013-03-17 12:01:28',
			'user_id' => 1,
			'userGroup_id' => 1,
			'form_id' => 1,
			'formGroup_id' => 1,
			'view' => 1,
			'submit' => 1,
			'setDefault' => 1,
			'setLogging' => 1,
			'undoOwn' => 1,
			'undoOthers' => 1
		),
	);

}
