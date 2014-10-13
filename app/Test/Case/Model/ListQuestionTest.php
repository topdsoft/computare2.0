<?php
App::uses('ListQuestion', 'Model');

/**
 * ListQuestion Test Case
 *
 */
class ListQuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.list_question',
		'app.list_template'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ListQuestion = ClassRegistry::init('ListQuestion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ListQuestion);

		parent::tearDown();
	}

}
