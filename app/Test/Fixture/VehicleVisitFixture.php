<?php
/**
 * VehicleVisit Fixture
 */
class VehicleVisitFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'vehicleVisits';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'exits' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'exit_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'vehicle_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
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
			'created' => '2019-03-21 11:11:06',
			'created_id' => 1,
			'exits' => '2019-03-21 11:11:06',
			'exit_id' => 1,
			'vehicle_id' => 1
		),
	);

}
