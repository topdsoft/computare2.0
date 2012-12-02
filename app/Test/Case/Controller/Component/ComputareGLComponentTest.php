<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareGLComponent', 'Controller/Component');

class ComputareGLComponentTest extends CakeTestCase {
	public $fixtures=array('app.glgroup','app.glaccount','app.glaccountDetail','app.glnote','app.glcheck','app.glentry');
	
	public function setUp() {
		parent::setUp();
		$this->Glgroup=ClassRegistry::init('Glgroup');
		$this->Glaccount=ClassRegistry::init('Glaccount');
		$this->GlaccountDetail=ClassRegistry::init('GlaccountDetail');
		$this->Glentry=ClassRegistry::init('Glentry');
		$this->Glcheck=ClassRegistry::init('Glcheck');
		$this->Glnote=ClassRegistry::init('Glnote');
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
		$account=$this->Glaccount->read(null,$this->Glaccount->getInsertId());
		$this->assertEquals($account['Glaccount']['glgroup_id'],1,'*glaccounts.glgroup_id not set');
		$account=$this->GlaccountDetail->find('all',array('conditions'=>array('GlaccountDetail.name'=>'Cash')));
		$this->assertNotNull($account,'*return is null');
		$this->assertEquals(count($account),1,'*did not find exactly one record');
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
		$account=$this->Glaccount->read(null,$account[0]['GlaccountDetail']['glaccount_id']);
		$this->assertEquals($account['Glaccount']['glgroup_id'],2,'*glaccounts.glgroup_id not updated');
		//test validation
		$newAcct['GlaccountDetail']['name']='Cash on Hand';
		$this->assertFalse($this->ComputareGLComponent->saveAccount($newAcct),'* failed to catch duplicate account name');
		$newAcct['GlaccountDetail']['created_id']=null;
		$this->assertFalse($this->ComputareGLComponent->saveAccount($newAcct),'* failed to catch empty created_id');
		$newAcct['GlaccountDetail']['name']='';
		$this->assertFalse($this->ComputareGLComponent->saveAccount($newAcct),'* failed to catch empty account name');
//debug($account);exit;
	}
	
	public function testPost() {
		//test posting to GL accounts
		$data=array(
			'debit'=>array(4=>110.99),
			'credit'=>array(2=>100,3=>10.99),
			'Glnote'=>array('text'=>'note data'),
			'Glcheck'=>array('checkNumber'=>1003),
			'Glentry'=>array('created_id'=>3)
		);
		$this->assertTrue($this->ComputareGLComponent->post($data),'*failed to post data');
		//verify saved data
		$this->assertEquals($this->Glentry->field('debit',array('glaccount_id'=>4)),110.99,'*acct4 debit failed');
		$this->assertEquals($this->Glentry->field('credit',array('glaccount_id'=>3)),10.99,'*acct3 credit failed');
		$this->assertEquals($this->Glentry->field('credit',array('glaccount_id'=>2)),100,'*acct2 credit failed');
		$lastEntry=$this->Glentry->read(null);
		$this->assertEquals($lastEntry['Glcheck']['checkNumber'],1003,'*check number not set');
		$this->assertEquals($lastEntry['Glcheck']['amount'],110.99,'*check amount not set');
		$this->assertEquals($lastEntry['Glnote']['text'],'note data','*check number not set');
		//test invalid check#
		$data['Glcheck']['checkNumber']='xxx';
		$this->assertFalse($this->ComputareGLComponent->post($data),'*failed to catch bad check number data');
		$data['Glcheck']['checkNumber']='';
		$this->assertTrue($this->ComputareGLComponent->post($data),'*failed to post data without check #');
		$data['Glnote']['text']='';
		$this->assertTrue($this->ComputareGLComponent->post($data),'*failed to post data without note');
		//check for debit-credit unequal
		$data['debit'][4]=69.69;
		$this->assertFalse($this->ComputareGLComponent->post($data),'*failed to catch debit!=credit');
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareCustomerComponentTest