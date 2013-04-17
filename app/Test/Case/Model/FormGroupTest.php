<?php
App::uses('FormGroup', 'Model');

/**
 * FormGroup Test Case
 *
 */
class FormGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.form_group',
		'app.form',
		'app.user_group',
		'app.forms_group',
		'app.user',
		'app.forms_user',
		'app.groups_user',
		'app.menu',
		'app.forms_menu',
		'app.menus_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FormGroup = ClassRegistry::init('FormGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FormGroup);

		parent::tearDown();
	}

}
