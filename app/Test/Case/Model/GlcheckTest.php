<?php
App::uses('Glcheck', 'Model');

/**
 * Glcheck Test Case
 *
 */
class GlcheckTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glcheck'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glcheck = ClassRegistry::init('Glcheck');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glcheck);

		parent::tearDown();
	}

}
