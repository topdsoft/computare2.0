<?php
App::uses('Glentry', 'Model');

/**
 * Glentry Test Case
 *
 */
class GlentryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glentry',
		'app.glaccount',
		'app.glaccountdetail',
		'app.glgroup',
		'app.glcheck'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glentry = ClassRegistry::init('Glentry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glentry);

		parent::tearDown();
	}

}
