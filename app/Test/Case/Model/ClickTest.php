<?php
App::uses('Click', 'Model');

/**
 * Click Test Case
 *
 */
class ClickTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.click',
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
		$this->Click = ClassRegistry::init('Click');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Click);

		parent::tearDown();
	}

}
