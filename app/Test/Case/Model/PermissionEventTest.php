<?php
App::uses('PermissionEvent', 'Model');

/**
 * PermissionEvent Test Case
 *
 */
class PermissionEventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permission_event'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PermissionEvent = ClassRegistry::init('PermissionEvent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PermissionEvent);

		parent::tearDown();
	}

}
