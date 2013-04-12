<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareAPComponent', 'Controller/Component');

class ComputareAPComponentTest extends CakeTestCase {
	public $fixtures=array('app.vendor','app.vendorDetail','app.address');
	
	public function setUp() {
		parent::setUp();
		$this->Vendor=ClassRegistry::init('Vendor');
//		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
		$Collection = new ComponentCollection();
		$this->ComputareAPComponent=new ComputareAPComponent($Collection);
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