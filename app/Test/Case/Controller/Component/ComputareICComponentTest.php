<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareICComponent', 'Controller/Component');

class ComputareICComponentTest extends CakeTestCase {
	public $fixtures=array('app.item','app.itemDetail','app.location','app.locationDetail','app.inventoryLock');
	
	public function setUp() {
		parent::setUp();
		$this->Item=ClassRegistry::init('Item');
//		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
		$Collection = new ComponentCollection();
		$this->ComputareICComponent=new ComputareICComponent($Collection);
		//setup mock auth component
		$this->ComputareICComponent->Auth = $this->getMock('Auth', array('user'));
		$this->ComputareICComponent->Auth->expects($this->any())->method('user')->with('id')->will($this->returnValue(14));
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
	
	/**
	 * id 5  lft 0 rght 3
	 * id 6  lft 1 rght 2 parent 5
	 * id 7  lft 4 rght 5
	 */
	public function testLockLocation() {
		//test locking a location
		$this->InventoryLock=ClassRegistry::init('InventoryLock');
		//setup some locations
		$this->InventoryLock->Location->save(array('id'=>5,'lft'=>0,'rght'=>3));
		$this->InventoryLock->Location->save(array('id'=>6,'lft'=>1,'rght'=>2,'parent_id'=>5));
		$this->InventoryLock->Location->save(array('id'=>7,'lft'=>4,'rght'=>5));
		//nothing should be locked
		$this->assertFalse($this->ComputareICComponent->checkLock(5),'* location_id==5 should not be locked');
		$this->assertFalse($this->ComputareICComponent->checkLock(6),'* location_id==6 should not be locked');
		$this->assertFalse($this->ComputareICComponent->checkLock(7),'* location_id==7 should not be locked');
		//lock parent location
		$this->assertTrue($this->ComputareICComponent->lockLocation(array('location_id'=>5)),'* location_id==5 not locked');
		//save lock id for later
		$lock_id=$this->InventoryLock->getInsertId();
		//check locks
		$this->assertTrue($this->ComputareICComponent->checkLock(5),'* location_id==5 should be locked');
		$this->assertTrue($this->ComputareICComponent->checkLock(6),'* location_id==6 should be locked');
		$this->assertFalse($this->ComputareICComponent->checkLock(7),'* location_id==7 should not be locked');
		//re-lock of id=6 should fail
		$this->assertFalse($this->ComputareICComponent->lockLocation(array('location_id'=>6)),'* location_id==6 re-locked');
		//lock location=7
		$this->assertTrue($this->ComputareICComponent->lockLocation(array('location_id'=>7)),'* location_id==7 not locked');
		//check locks
		$this->assertTrue($this->ComputareICComponent->checkLock(5),'* location_id==5 should be locked');
		$this->assertTrue($this->ComputareICComponent->checkLock(6),'* location_id==6 should be locked');
		$this->assertTrue($this->ComputareICComponent->checkLock(7),'* location_id==7 should be locked');
		//unlock parent
		$this->assertTrue($this->ComputareICComponent->unlockLocation($lock_id),'* unlock failed');
		//check locks
		$this->assertFalse($this->ComputareICComponent->checkLock(5),'* location_id==5 should not be locked');
		$this->assertFalse($this->ComputareICComponent->checkLock(6),'* location_id==6 should not be locked');
		$this->assertTrue($this->ComputareICComponent->checkLock(7),'* location_id==7 should be locked');
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareAPComponentTest