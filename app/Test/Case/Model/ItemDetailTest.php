<?php
App::uses('ItemDetail', 'Model');

/**
 * ItemDetail Test Case
 *
 */
class ItemDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_detail',
		'app.item',
		'app.item_cost',
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
		'app.items_vendor',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemDetail = ClassRegistry::init('ItemDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemDetail);

		parent::tearDown();
	}

}
