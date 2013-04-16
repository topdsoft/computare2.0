<?php
App::uses('CalendarPopUp', 'Model');

/**
 * CalendarPopUp Test Case
 *
 */
class CalendarPopUpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calendar_pop_up',
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
		$this->CalendarPopUp = ClassRegistry::init('CalendarPopUp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CalendarPopUp);

		parent::tearDown();
	}

}
