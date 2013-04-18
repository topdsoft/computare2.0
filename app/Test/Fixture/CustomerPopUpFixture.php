<?php
/**
 * CustomerPopUpFixture
 *
 */
class CustomerPopUpFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'customerPopUps';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'x_pos' => array('type' => 'integer', 'null' => false, 'default' => null),
		'y_pos' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 0)
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
			'created' => '2013-04-18 16:45:21',
			'user_id' => 1,
			'x_pos' => 1,
			'y_pos' => 1
		),
	);

}
