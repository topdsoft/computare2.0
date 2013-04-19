<?php
App::uses('Backup', 'Model');

/**
 * Backup Test Case
 *
 */
class BackupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.backup'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Backup = ClassRegistry::init('Backup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Backup);

		parent::tearDown();
	}

}
