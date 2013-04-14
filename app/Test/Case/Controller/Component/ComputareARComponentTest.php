<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareARComponent', 'Controller/Component');

class ComputareARComponentTest extends CakeTestCase {
	public $fixtures=array(
		'app.customer',
		'app.customerDetail',
		'app.address',
		'app.salesOrder',
		'app.salesOrderDetail',
		'app.salesOrderType'
	);
	
	public function setUp() {
		parent::setUp();
		$this->SalesOrder=ClassRegistry::init('SalesOrder');
//		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
//		$this->CustomerDetail=ClassRegistry::init('CustomerDetail');
		$Collection = new ComponentCollection();
		$this->ComputareARComponent=new ComputareARComponent($Collection);
	}
	
	public function testSaveSO() {
		//test saving a new SO
		$data['SalesOrder']['customer_id']=1;
		$data['SalesOrder']['salesOrderType_id']=1;
		$this->assertTrue($this->ComputareARComponent->saveSO($data),'* failed to save new so');
		//get results and test
		$results=$this->SalesOrder->read(null);
		$this->assertEquals(1,$results['SalesOrder']['customer_id'],'* failed to set customer_id');
		$this->assertEquals(1,$results['SalesOrder']['salesOrderType_id'],'* failed to set salesOrderType_id');
		//test non active customer fail
		$data['SalesOrder']['customer_id']=2;
		$this->assertFalse($this->ComputareARComponent->saveSO($data),'* failed to catch inactive customer');
		//test non active SO type fail
		$data['SalesOrder']['customer_id']=1;
		$data['SalesOrder']['salesOrderType_id']=2;
		$this->assertFalse($this->ComputareARComponent->saveSO($data),'* failed to catch inactive SOtype');
		//test missing SO type fail
		$data['SalesOrder']['customer_id']=1;
		unset($data['SalesOrder']['salesOrderType_id']);
		$this->assertFalse($this->ComputareARComponent->saveSO($data),'* failed to catch missing SOtype');
		//test missing customer fail
		$data['SalesOrder']['salesOrderType_id']=1;
		unset($data['SalesOrder']['customer_id']);
		$this->assertFalse($this->ComputareARComponent->saveSO($data),'* failed to catch missing customer');
		//test voiding SO
		$results['SalesOrder']['status']='V';
		$this->assertTrue($this->ComputareARComponent->saveSO($results),'* failed to void so');
		//test closing SO (crate new so to close)
		unset($results,$data);
		$data['SalesOrder']['customer_id']=1;
		$data['SalesOrder']['salesOrderType_id']=1;
		$this->ComputareARComponent->saveSO($data);
		$results=$this->SalesOrder->read(null);
		$results['SalesOrder']['status']='C';
		$this->assertTrue($this->ComputareARComponent->saveSO($results),'* failed to close SO');
// debug($results);exit;
	}
	
	public function testSaveLine() {
		//test saving a SO line
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareAPComponentTest