<?php
App::uses('Htmlevent', 'Model');

/**
 * Htmlevent Test Case
 *
 */
class HtmleventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.htmlevent',
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
		'app.formevent'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Htmlevent = ClassRegistry::init('Htmlevent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Htmlevent);

		parent::tearDown();
	}

}
