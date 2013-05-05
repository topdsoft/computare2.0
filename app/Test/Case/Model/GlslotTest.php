<?php
App::uses('Glslot', 'Model');

/**
 * Glslot Test Case
 *
 */
class GlslotTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glslot',
		'app.glaccount',
		'app.glaccount_detail',
		'app.glgroup',
		'app.glentry',
		'app.glcheck',
		'app.glnote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glslot = ClassRegistry::init('Glslot');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glslot);

		parent::tearDown();
	}

}
