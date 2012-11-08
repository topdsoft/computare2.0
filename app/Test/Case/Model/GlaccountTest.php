<?php
App::uses('Glaccount', 'Model');

/**
 * Glaccount Test Case
 *
 */
class GlaccountTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glaccount',
		'app.glaccountdetail',
		'app.glentry'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glaccount = ClassRegistry::init('Glaccount');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glaccount);

		parent::tearDown();
	}

}
