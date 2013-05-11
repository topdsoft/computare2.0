<?php
App::uses('IssueType', 'Model');

/**
 * IssueType Test Case
 *
 */
class IssueTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.issue_type',
		'app.gl_account'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IssueType = ClassRegistry::init('IssueType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IssueType);

		parent::tearDown();
	}

}
