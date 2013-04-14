<?php
App::uses('SalesOrder', 'Model');

/**
 * SalesOrder Test Case
 *
 */
class SalesOrderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sales_order',
		'app.sales_order_type',
		'app.customer',
		'app.customer_detail',
		'app.address',
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
		'app.service',
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
		$this->SalesOrder = ClassRegistry::init('SalesOrder');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SalesOrder);

		parent::tearDown();
	}

}
