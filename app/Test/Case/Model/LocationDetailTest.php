<?php
App::uses('LocationDetail', 'Model');

/**
 * LocationDetail Test Case
 *
 */
class LocationDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.location_detail',
		'app.location',
		'app.item',
		'app.item_detail',
		'app.item_cost',
		'app.vendor',
		'app.item_serial_number',
		'app.item_location',
		'app.item_transaction',
		'app.sale',
		'app.receipt',
		'app.purchase_order_detail',
		'app.sales_order',
		'app.sales_order_detail',
		'app.purchase_order',
		'app.customer',
		'app.customer_detail',
		'app.customers_item',
		'app.item_group',
		'app.groups_item',
		'app.image',
		'app.images_item',
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
		$this->LocationDetail = ClassRegistry::init('LocationDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LocationDetail);

		parent::tearDown();
	}

}
