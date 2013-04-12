<?php
App::uses('Address', 'Model');

/**
 * Address Test Case
 *
 */
class AddressTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.address',
		'app.customer',
		'app.customer_detail',
		'app.vendor',
		'app.vendor_detail',
		'app.item_cost',
		'app.item',
		'app.item_detail',
		'app.item_category',
		'app.item_serial_number',
		'app.items_location',
		'app.item_transaction',
		'app.location',
		'app.location_detail',
		'app.sale',
		'app.receipt',
		'app.purchase_order_detail',
		'app.purchase_order',
		'app.sales_order_detail',
		'app.customers_item',
		'app.item_group',
		'app.groups_item',
		'app.image',
		'app.images_item',
		'app.items_vendor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Address = ClassRegistry::init('Address');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Address);

		parent::tearDown();
	}

}
