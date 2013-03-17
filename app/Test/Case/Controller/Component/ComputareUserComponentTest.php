<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareUserComponent', 'Controller/Component');

class ComputareUserComponentTest extends CakeTestCase {
	public $fixtures=array('app.user','app.userGroup');
	
	public function setUp() {
		parent::setUp();
		$this->User=ClassRegistry::init('User');
		$this->UserGroup=ClassRegistry::init('UserGroup');
		$Collection = new ComponentCollection();
		$this->ComputareUserComponent=new ComputareUserComponent($Collection);
	}
	
	public function testSaveUser() {
		//test saving a new user
	}

	public function testSetUserToFormPermission() {
		
	}
	
	public function testSetUserToFormGroupPermission() {
		
	}
	
	public function testSetUserGroupToFormPermission() {
		
	}
	
	public function testSetUserGroupToFormGroupPermission() {
		
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareCustomerComponentTest