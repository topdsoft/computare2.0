<?php
App::uses('ItemSerialNumber', 'Model');

/**
 * ItemSerialNumber Test Case
 *
 */
class ItemSerialNumberTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_serial_number',
		'app.item_location',
		'app.item',
		'app.item_cost',
		'app.vendor',
		'app.item_detail',
		'app.item_transaction',
		'app.purchase_order_detail',
		'app.receipt',
		'app.sale',
		'app.sales_order_detail',
		'app.customer',
		'app.customer_detail',
		'app.customers_item',
		'app.group',
		'app.groups_item',
		'app.image',
		'app.images_item',
		'app.location',
		'app.items_location',
		'app.items_vendor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemSerialNumber = ClassRegistry::init('ItemSerialNumber');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemSerialNumber);

		parent::tearDown();
	}

}
