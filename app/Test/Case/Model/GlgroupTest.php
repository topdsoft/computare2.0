<?php
App::uses('Glgroup', 'Model');

/**
 * Glgroup Test Case
 *
 */
class GlgroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glgroup',
		'app.glaccountdetail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glgroup = ClassRegistry::init('Glgroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glgroup);

		parent::tearDown();
	}

}
