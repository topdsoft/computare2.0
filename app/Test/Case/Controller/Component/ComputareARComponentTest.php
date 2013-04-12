<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareARComponent', 'Controller/Component');

class ComputareARComponentTest extends CakeTestCase {
	public $fixtures=array('app.customer','app.customerDetail','app.address');
	
	public function setUp() {
		parent::setUp();
		$this->Customer=ClassRegistry::init('Customer');
//		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
		$Collection = new ComponentCollection();
		$this->ComputareARComponent=new ComputareARComponent($Collection);
	}
	
	public function testSaveVendor() {
		//test saving a vendor
	}
	
	public function testSavePO() {
		//test saving a vendor
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareAPComponentTest