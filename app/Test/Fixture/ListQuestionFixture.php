<?php
/**
 * ListQuestionFixture
 *
 */
class ListQuestionFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'listQuestions';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'rank' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'label' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'listTemplate_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'required' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'listTemplate_id' => array('column' => 'listTemplate_id', 'unique' => 0)
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
			'created' => '2014-10-12 17:02:44',
			'created_id' => 1,
			'rank' => 1,
			'label' => 'Lorem ipsum dolor sit amet',
			'type' => 1,
			'listTemplate_id' => 1,
			'required' => 1
		),
	);

}
