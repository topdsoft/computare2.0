<?php
/**
 * GlentryFixture
 *
 */
class GlentryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'postDate' => array('type' => 'date', 'null' => false, 'default' => null),
		'glaccount_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'glcheck_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'glnote_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'debit' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '12,2'),
		'credit' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '12,2'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'glaccount_id' => array('column' => 'glaccount_id', 'unique' => 0)
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
			'created' => '2012-11-08 15:16:03',
			'created_id' => 1,
			'postDate' => '2012-11-08 15:16:03',
			'glaccount_id' => 1,
			'glcheck_id' => 1,
			'debit' => 1,
			'credit' => 1
		),
	);

}
