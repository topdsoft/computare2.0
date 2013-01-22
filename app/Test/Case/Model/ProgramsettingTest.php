<?php
App::uses('Programsetting', 'Model');

/**
 * Programsetting Test Case
 *
 */
class ProgramsettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.programsetting'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Programsetting = ClassRegistry::init('Programsetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Programsetting);

		parent::tearDown();
	}

}
