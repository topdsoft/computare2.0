<?php
/**
 * GlslotFixture
 *
 */
class GlslotFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'removed' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'removed_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'slot' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'glaccount_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'debit' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'credit' => array('type' => 'boolean', 'null' => false, 'default' => null),
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
			'created' => '2013-05-05 15:00:18',
			'created_id' => 1,
			'removed' => '2013-05-05 15:00:18',
			'removed_id' => 1,
			'active' => 1,
			'slot' => 'Lorem ipsum dolor ',
			'glaccount_id' => 1,
			'debit' => 1,
			'credit' => 1
		),
	);

}
