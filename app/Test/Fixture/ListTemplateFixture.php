<?php
/**
 * ListTemplateFixture
 *
 */
class ListTemplateFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'listTemplates';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'removed' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'removed_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'newList_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'linkedTo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
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
			'created' => '2014-10-12 16:59:39',
			'created_id' => 1,
			'active' => 1,
			'removed' => '2014-10-12 16:59:39',
			'removed_id' => 1,
			'newList_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'linkedTo_id' => 1
		),
	);

}
