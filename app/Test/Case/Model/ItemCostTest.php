<?php
App::uses('ItemCost', 'Model');

/**
 * ItemCost Test Case
 *
 */
class ItemCostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_cost',
		'app.item',
		'app.item_detail',
		'app.item_serial_number',
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
		'app.vendor',
		'app.items_vendor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemCost = ClassRegistry::init('ItemCost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemCost);

		parent::tearDown();
	}

}
