<?php
App::uses('AddressesController', 'Controller');

/**
 * AddressesController Test Case
 *
 */
class AddressesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.address',
		'app.customer',
		'app.customerDetail',
		'app.vendor',
		'app.vendorDetail',
	);

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		//test invalid address_id validtion
// 		$this->assertFalse($this->testAction('/addresses/delete/0'));
		//test deleteing customer address
		$this->testAction('/addresses/delete/1');
		$result=ClassRegistry::init('Address')->read(null,1);
		$this->assertFalse($result['Address']['active'],'*failed to delete address of customer');
		//test deleteing vendor address
		$this->testAction('/addresses/delete/2');
		$result=ClassRegistry::init('Address')->read(null,2);
		$this->assertFalse($result['Address']['active'],'*failed to delete address of vendor');
//		debug($result);exit;
	}

}
