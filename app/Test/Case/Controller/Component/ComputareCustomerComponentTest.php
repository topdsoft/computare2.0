<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareCustomerComponent', 'Controller/Component');

class ComputareCustomerComponentTest extends CakeTestCase {
	public $fixtures=array('app.customer','app.customerDetail');
	
	public function setUp() {
		parent::setUp();
		$this->Customer=ClassRegistry::init('Customer');
		$this->CustomerData=ClassRegistry::init('CustomerData');
		$Collection = new ComponentCollection();
		$this->ComputareCustomerComponent=new ComputareCustomerComponent($Collection);
	}
	
	public function testSave() {
		//test saving a new customer
		$newCust=array('CustomerDetail'=>array(
			'companyName'=>'ABC Corp',
			'firstName'=>'New',
			'lastName'=>'Customer',
			'address1' => 'a1',
			'address2' => 'a2',
			'city' => 'Portland',
			'state' => 'IA',
			'zip' => '50000',
			'email' => 'nc@me.com',
			'phone' => '5151221212',
			'notes' => 'notes here',
			'created_id'=>1
		),'Customer'=>array('id'=>null,'customerDetail_id'=>0));
		$this->ComputareCustomerComponent->save($newCust);
		$record=$this->Customer->find('all',array('conditions'=>array('CustomerDetail.companyName'=>'ABC Corp')));
		//test saved values
		$this->assertEquals(true,$record[0]['Customer']['active'],'*active save failure');
		$this->assertEquals(1,$record[0]['Customer']['created_id'],'*Created_id save failure');
		$this->assertEquals('New',$record[0]['CustomerDetail']['firstName'],'*Firstname save failure');
		$this->assertEquals('Customer',$record[0]['CustomerDetail']['lastName'],'*Last name save failure');
		$this->assertEquals('a1',$record[0]['CustomerDetail']['address1'],'*Address1 save failure');
		$this->assertEquals('a2',$record[0]['CustomerDetail']['address2'],'*address2 save failure');
		$this->assertEquals('Portland',$record[0]['CustomerDetail']['city'],'*city save failure');
		$this->assertEquals('IA',$record[0]['CustomerDetail']['state'],'*state save failure');
		$this->assertEquals('50000',$record[0]['CustomerDetail']['zip'],'*zip save failure');
		$this->assertEquals('nc@me.com',$record[0]['CustomerDetail']['email'],'*email save failure');
		$this->assertEquals('5151221212',$record[0]['CustomerDetail']['phone'],'*phone save failure');
		$this->assertEquals('notes here',$record[0]['CustomerDetail']['notes'],'*notes save failure');
		//now make some changes and test saving them
		$record[0]['CustomerDetail']['companyName'].='x';
		$record[0]['CustomerDetail']['firstName'].='x';
		$record[0]['CustomerDetail']['lastName'].='x';
		$record[0]['CustomerDetail']['address1'].='x';
		$record[0]['CustomerDetail']['address2'].='x';
		$record[0]['CustomerDetail']['city'].='x';
		$record[0]['CustomerDetail']['state']='OR';
		$record[0]['CustomerDetail']['zip'].='x';
		$record[0]['CustomerDetail']['email'].='x';
		$record[0]['CustomerDetail']['phone'].='x';
		$record[0]['CustomerDetail']['notes'].='x';
		$record[0]['CustomerDetail']['created_id']=3;
		$this->ComputareCustomerComponent->save($record[0]);
		$record=$this->Customer->find('all',array('conditions'=>array('Customer.id'=>$record[0]['Customer']['id'])));
		//test saved values
		$this->assertEquals(true,$record[0]['Customer']['active'],'*active save failure');
		$this->assertEquals(3,$record[0]['CustomerDetail']['created_id'],'*Created_id save failure');
		$this->assertEquals('Newx',$record[0]['CustomerDetail']['firstName'],'*Firstname save failure');
		$this->assertEquals('Customerx',$record[0]['CustomerDetail']['lastName'],'*Last name save failure');
		$this->assertEquals('a1x',$record[0]['CustomerDetail']['address1'],'*Address1 save failure');
		$this->assertEquals('a2x',$record[0]['CustomerDetail']['address2'],'*address2 save failure');
		$this->assertEquals('Portlandx',$record[0]['CustomerDetail']['city'],'*city save failure');
		$this->assertEquals('OR',$record[0]['CustomerDetail']['state'],'*state save failure');
		$this->assertEquals('50000x',$record[0]['CustomerDetail']['zip'],'*zip save failure');
		$this->assertEquals('nc@me.comx',$record[0]['CustomerDetail']['email'],'*email save failure');
		$this->assertEquals('5151221212x',$record[0]['CustomerDetail']['phone'],'*phone save failure');
		$this->assertEquals('notes herex',$record[0]['CustomerDetail']['notes'],'*notes save failure');
		//delete record
		$this->ComputareCustomerComponent->delete($record[0]['Customer']['id'],6);
		$record=$this->Customer->find('all',array('conditions'=>array('Customer.id'=>$record[0]['Customer']['id'])));
		$this->assertEquals(false,$record[0]['Customer']['active'],'*delete failure');
		$this->assertEquals(6,$record[0]['Customer']['deleted_id'],'*delete_id failure');
		$this->assertFalse($this->ComputareCustomerComponent->delete(0,0),'*failed to return false on faulty customer id');
//$this->Customer->create();
//$this->Customer->save(array('created_id'=>2));
//debug($record);exit;
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareCustomerComponentTest