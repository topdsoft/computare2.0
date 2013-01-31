<?php
App::uses('Sysevent', 'Model');

/**
 * Sysevent Test Case
 *
 */
class SyseventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sysevent',
		'app.permissionevent',
		'app.errorevent',
		'app.htmlevent',
		'app.formevent'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sysevent = ClassRegistry::init('Sysevent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sysevent);

		parent::tearDown();
	}

}
