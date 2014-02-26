<?php
App::uses('SalesOrderMod', 'Model');

/**
 * SalesOrderMod Test Case
 *
 */
class SalesOrderModTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sales_order_mod',
		'app.sales_order',
		'app.sales_order_type',
		'app.location',
		'app.location_detail',
		'app.location_type',
		'app.inventory_lock',
		'app.item',
		'app.item_detail',
		'app.item_category',
		'app.item_cost',
		'app.vendor',
		'app.vendor_detail',
		'app.address',
		'app.customer',
		'app.customer_detail',
		'app.customer_group',
		'app.customer_groups_item',
		'app.service',
		'app.customer_groups_service',
		'app.contact',
		'app.sale',
		'app.sales_order_detail',
		'app.item_transaction',
		'app.receipt',
		'app.purchase_order',
		'app.purchase_order_detail',
		'app.items_vendor',
		'app.item_serial_number',
		'app.items_location',
		'app.customers_item',
		'app.item_group',
		'app.groups_item',
		'app.image',
		'app.images_item',
		'app.glaccount',
		'app.glaccount_detail',
		'app.glgroup',
		'app.glentry',
		'app.glcheck',
		'app.glnote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SalesOrderMod = ClassRegistry::init('SalesOrderMod');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SalesOrderMod);

		parent::tearDown();
	}

}
