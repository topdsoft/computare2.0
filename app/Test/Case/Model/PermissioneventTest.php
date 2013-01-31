<?php
App::uses('Permissionevent', 'Model');

/**
 * Permissionevent Test Case
 *
 */
class PermissioneventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permissionevent',
		'app.user',
		'app.form',
		'app.group',
		'app.forms_group',
		'app.groups_user',
		'app.menu',
		'app.forms_menu',
		'app.menus_user',
		'app.forms_user',
		'app.sysevent',
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
		$this->Permissionevent = ClassRegistry::init('Permissionevent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Permissionevent);

		parent::tearDown();
	}

}
