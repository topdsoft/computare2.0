<?php
App::uses('CustomerDetail', 'Model');

/**
 * CustomerDetail Test Case
 *
 */
class CustomerDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer_detail',
		'app.customer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CustomerDetail = ClassRegistry::init('CustomerDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CustomerDetail);

		parent::tearDown();
	}

}
