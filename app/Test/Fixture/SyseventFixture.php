<?php
/**
 * SyseventFixture
 *
 */
class SyseventFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'remoteaddr' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'event_type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'permissionevent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'errorevent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'htmlevent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'formevent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
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
			'created' => '2013-01-31 11:45:35',
			'created_id' => 1,
			'remoteaddr' => 'Lorem ipsum dolor ',
			'event_type' => 1,
			'permissionevent_id' => 1,
			'errorevent_id' => 1,
			'htmlevent_id' => 1,
			'formevent_id' => 1
		),
	);

}
