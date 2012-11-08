<?php
App::uses('Glaccountdetail', 'Model');

/**
 * Glaccountdetail Test Case
 *
 */
class GlaccountdetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glaccountdetail',
		'app.glaccount',
		'app.glentry',
		'app.glgroup'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glaccountdetail = ClassRegistry::init('Glaccountdetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glaccountdetail);

		parent::tearDown();
	}

}
