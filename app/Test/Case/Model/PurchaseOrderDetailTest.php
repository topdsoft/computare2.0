<?php
App::uses('PurchaseOrderDetail', 'Model');

/**
 * PurchaseOrderDetail Test Case
 *
 */
class PurchaseOrderDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_order_detail',
		'app.sales_order',
		'app.item',
		'app.item_cost',
		'app.vendor',
		'app.item_detail',
		'app.item_serial_number',
		'app.item_location',
		'app.item_transaction',
		'app.sale',
		'app.receipt',
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
		$this->PurchaseOrderDetail = ClassRegistry::init('PurchaseOrderDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseOrderDetail);

		parent::tearDown();
	}

}
