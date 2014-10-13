<?php
App::uses('CompletedList', 'Model');

/**
 * CompletedList Test Case
 *
 */
class CompletedListTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.completed_list',
		'app.list_template',
		'app.list_question',
		'app.customer',
		'app.customer_detail',
		'app.customer_group',
		'app.item',
		'app.item_detail',
		'app.item_category',
		'app.item_cost',
		'app.vendor',
		'app.vendor_detail',
		'app.address',
		'app.contact',
		'app.purchase_order',
		'app.purchase_order_detail',
		'app.receipt',
		'app.items_vendor',
		'app.item_serial_number',
		'app.items_location',
		'app.item_transaction',
		'app.location',
		'app.location_detail',
		'app.location_type',
		'app.inventory_lock',
		'app.sale',
		'app.service',
		'app.sales_order_detail',
		'app.sales_order',
		'app.sales_order_type',
		'app.issue_type',
		'app.glaccount',
		'app.glaccount_detail',
		'app.glgroup',
		'app.glentry',
		'app.glcheck',
		'app.glnote',
		'app.sales_order_fee',
		'app.sales_order_mod',
		'app.customers_item',
		'app.item_group',
		'app.groups_item',
		'app.image',
		'app.images_item',
		'app.customer_groups_item',
		'app.customer_groups_service'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CompletedList = ClassRegistry::init('CompletedList');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CompletedList);

		parent::tearDown();
	}

}
