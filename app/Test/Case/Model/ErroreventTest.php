<?php
App::uses('Errorevent', 'Model');

/**
 * Errorevent Test Case
 *
 */
class ErroreventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.errorevent',
		'app.sysevent',
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
		$this->Errorevent = ClassRegistry::init('Errorevent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Errorevent);

		parent::tearDown();
	}

}
