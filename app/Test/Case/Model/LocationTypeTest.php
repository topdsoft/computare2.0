<?php
App::uses('LocationType', 'Model');

/**
 * LocationType Test Case
 *
 */
class LocationTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.location_type',
		'app.location',
		'app.location_detail',
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
		'app.purchase_order',
		'app.purchase_order_detail',
		'app.receipt',
		'app.items_vendor',
		'app.item_serial_number',
		'app.items_location',
		'app.item_transaction',
		'app.sale',
		'app.sales_order_detail',
		'app.sales_order',
		'app.sales_order_type',
		'app.glaccount',
		'app.glaccount_detail',
		'app.glgroup',
		'app.glentry',
		'app.glcheck',
		'app.glnote',
		'app.customers_item',
		'app.item_group',
		'app.groups_item',
		'app.image',
		'app.images_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LocationType = ClassRegistry::init('LocationType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LocationType);

		parent::tearDown();
	}

}
