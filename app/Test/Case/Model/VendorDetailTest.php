<?php
App::uses('VendorDetail', 'Model');

/**
 * VendorDetail Test Case
 *
 */
class VendorDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vendor_detail',
		'app.vendor',
		'app.address',
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
		'app.customer',
		'app.customer_detail',
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
		$this->VendorDetail = ClassRegistry::init('VendorDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VendorDetail);

		parent::tearDown();
	}

}
