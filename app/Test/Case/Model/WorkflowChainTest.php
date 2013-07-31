<?php
App::uses('WorkflowChain', 'Model');

/**
 * WorkflowChain Test Case
 *
 */
class WorkflowChainTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.workflow_chain',
		'app.link'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WorkflowChain = ClassRegistry::init('WorkflowChain');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorkflowChain);

		parent::tearDown();
	}

}
