<?php
App::uses('Task', 'Model');

/**
 * Task Test Case
 *
 */
class TaskTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task',
		'app.project',
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
		'app.purchase_order',
		'app.purchase_order_detail',
		'app.receipt',
		'app.items_vendor',
		'app.item_serial_number',
		'app.items_location',
		'app.item_transaction',
		'app.location',
		'app.location_detail',
		'app.inventory_lock',
		'app.sale',
		'app.sales_order_detail',
		'app.sales_order',
		'app.sales_order_type',
		'app.service',
		'app.customers_item',
		'app.item_group',
		'app.groups_item',
		'app.image',
		'app.images_item',
		'app.customer_groups_item',
		'app.customer_groups_service',
		'app.time_record',
		'app.user',
		'app.form',
		'app.form_group',
		'app.menu',
		'app.forms_menu',
		'app.menus_user',
		'app.forms_user',
		'app.user_group',
		'app.groups_user',
		'app.users_task'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Task = ClassRegistry::init('Task');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Task);

		parent::tearDown();
	}

}
