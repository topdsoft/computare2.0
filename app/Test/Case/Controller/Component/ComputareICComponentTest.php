<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareICComponent', 'Controller/Component');

class ComputareICComponentTest extends CakeTestCase {
	public $fixtures=array('app.item','app.itemDetail','app.location');
	
	public function setUp() {
		parent::setUp();
		$this->Item=ClassRegistry::init('Item');
//		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
		$Collection = new ComponentCollection();
		$this->ComputareICComponent=new ComputareICComponent($Collection);
	}
	
	public function testSaveItem() {
		//test saving a item
	}
	
	public function testSaveLocation() {
		//test saving a location
	}
	
	public function testSaveItemGroup() {
		//test saving a item
	}
	
	public function testSaveItemCategory() {
		//test saving a item
	}
	
	public function testReceive() {
		//test saving a item
	}
	
	public function testTransfer() {
		//test saving a item
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareAPComponentTest