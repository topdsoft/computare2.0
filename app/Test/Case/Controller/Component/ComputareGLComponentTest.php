<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareGLComponent', 'Controller/Component');

class ComputareGLComponentTest extends CakeTestCase {
	public $fixtures=array('app.glgroup','app.glaccount','app.glaccountDetail');
	
	public function setUp() {
		parent::setUp();
		$this->Glgroup=ClassRegistry::init('Glgroup');
		$this->Glaccount=ClassRegistry::init('Glaccount');
		$this->GlaccountDetail=ClassRegistry::init('GlaccountDetail');
		$Collection = new ComponentCollection();
		$this->ComputareGLComponent=new ComputareGLComponent($Collection);
	}
	
	public function testSaveGroup() {
		//test saving new GL group
		$newGroup=array('Glgroup'=>array('created_id'=>6,'name'=>'Assets'));
		$this->assertTrue($this->ComputareGLComponent->saveGroup($newGroup),'*failed in save call');
		//read saved data
		$record=$this->Glgroup->find('all',array('conditions'=>array('Glgroup.name'=>'Assets')));
		$this->assertNotNull($record,'*record is null');
		$this->assertEquals(count($record),1,'*did not find one record');
		$this->assertEquals($record[0]['Glgroup']['created_id'],6,'*user_id not set correctly');
		//test failure for no created_id set
		$this->assertFalse($this->ComputareGLComponent->saveGroup(array('Glgroup'=>array('name'=>'x'))),'*failed catch missing created_id');
		$this->assertFalse($this->ComputareGLComponent->saveGroup(array('Glgroup'=>array('name'=>'Assets','created_id'=>3))),'*failed catch repeat name');
		$this->assertFalse($this->ComputareGLComponent->saveGroup(array('Glgroup'=>array('name'=>'','created_id'=>3))),'*failed catch empty name');
	}
	
	public function testSaveAccount() {
		//test saving and editing a GL account
		$newAcct=array('GlaccountDetail'=>array('created_id'=>3,'glgroup_id'=>1,'name'=>'Cash'),'Glaccount'=>array('id'=>null));
		$this->assertTrue($this->ComputareGLComponent->saveAccount($newAcct),'*Failed to save new account');
		//test saved data
		$account=$this->GlaccountDetail->find('all',array('conditions'=>array('GlaccountDetail.name'=>'Cash')));
		$this->assertNotNull($account,'*return is null');
		$this->assertEquals(count($account),1,'*did not find one record');
		$this->assertEquals($account[0]['Glaccount']['created_id'],3,'*glaccount created_id not set');
		$this->assertEquals($account[0]['GlaccountDetail']['created_id'],3,'*glaccountDetail created_id not set');
		$this->assertEquals($account[0]['GlaccountDetail']['glgroup_id'],1,'*glaccountDetail glgroup_id not set');
		//test data edit
		$account[0]['GlaccountDetail']['name']='Cash on Hand';
		$account[0]['GlaccountDetail']['glgroup_id']=2;
		$this->assertTrue($this->ComputareGLComponent->saveAccount($account[0]),'*failed to modify data');
		$account=$this->GlaccountDetail->find('all',array('conditions'=>array('GlaccountDetail.name'=>'Cash on Hand')));
		$this->assertEquals(count($account),1,'*did not find one record');
		$this->assertEquals($account[0]['GlaccountDetail']['glgroup_id'],2,'*glaccountDetail glgroup_id not changed');
		//test validation
		$newAcct['GlaccountDetail']['name']='Cash on Hand';
		$this->assertFalse($this->ComputareGLComponent->saveAccount($newAcct),'* failed to catch duplicate account name');
		$newAcct['GlaccountDetail']['created_id']=null;
		$this->assertFalse($this->ComputareGLComponent->saveAccount($newAcct),'* failed to catch empty created_id');
		$newAcct['GlaccountDetail']['name']='';
		$this->assertFalse($this->ComputareGLComponent->saveAccount($newAcct),'* failed to catch empty account name');
//debug($account);exit;
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareCustomerComponentTest