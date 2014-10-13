<?php
App::uses('ListTemplate', 'Model');

/**
 * ListTemplate Test Case
 *
 */
class ListTemplateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.list_template',
		'app.list_question'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ListTemplate = ClassRegistry::init('ListTemplate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ListTemplate);

		parent::tearDown();
	}

}
