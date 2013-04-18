<?php
App::uses('ItemPopUp', 'Model');

/**
 * ItemPopUp Test Case
 *
 */
class ItemPopUpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_pop_up',
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
		$this->ItemPopUp = ClassRegistry::init('ItemPopUp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemPopUp);

		parent::tearDown();
	}

}
