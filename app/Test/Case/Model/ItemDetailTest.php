<?php
App::uses('ItemDetail', 'Model');

/**
 * ItemDetail Test Case
 *
 */
class ItemDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_detail',
		'app.item',
		'app.item_s_number',
		'app.item_transaction',
		'app.image',
		'app.images_item',
		'app.location',
		'app.items_location',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemDetail = ClassRegistry::init('ItemDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemDetail);

		parent::tearDown();
	}

}
