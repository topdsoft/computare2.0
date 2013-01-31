<?php
App::uses('Formevent', 'Model');

/**
 * Formevent Test Case
 *
 */
class FormeventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formevent',
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
		'app.errorevent',
		'app.htmlevent'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Formevent = ClassRegistry::init('Formevent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formevent);

		parent::tearDown();
	}

}
