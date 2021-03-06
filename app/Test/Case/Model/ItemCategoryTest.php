<?php
App::uses('ItemCategory', 'Model');

/**
 * ItemCategory Test Case
 *
 */
class ItemCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_category',
		'app.item',
		'app.item_detail',
		'app.item_cost',
		'app.vendor',
		'app.item_serial_number',
		'app.item_location',
		'app.item_transaction',
		'app.location',
		'app.location_detail',
		'app.items_location',
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
		$this->ItemCategory = ClassRegistry::init('ItemCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemCategory);

		parent::tearDown();
	}

}
