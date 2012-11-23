<?php
App::uses('Glnote', 'Model');

/**
 * Glnote Test Case
 *
 */
class GlnoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.glnote',
		'app.glentry',
		'app.glaccount',
		'app.glaccount_detail',
		'app.glgroup',
		'app.glcheck'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Glnote = ClassRegistry::init('Glnote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Glnote);

		parent::tearDown();
	}

}
