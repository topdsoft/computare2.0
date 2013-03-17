<?php
App::uses('PermissionSet', 'Model');

/**
 * PermissionSet Test Case
 *
 */
class PermissionSetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permission_set',
		'app.user',
		'app.form',
		'app.form_group',
		'app.user_group',
		'app.forms_group',
		'app.groups_user',
		'app.menu',
		'app.forms_menu',
		'app.menus_user',
		'app.forms_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PermissionSet = ClassRegistry::init('PermissionSet');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PermissionSet);

		parent::tearDown();
	}

}
