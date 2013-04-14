<?php
App::uses('SalesOrderType', 'Model');

/**
 * SalesOrderType Test Case
 *
 */
class SalesOrderTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sales_order_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SalesOrderType = ClassRegistry::init('SalesOrderType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SalesOrderType);

		parent::tearDown();
	}

}
