<?php
App::uses('ItemGroup', 'Model');

/**
 * ItemGroup Test Case
 *
 */
class ItemGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemGroup = ClassRegistry::init('ItemGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemGroup);

		parent::tearDown();
	}

}
