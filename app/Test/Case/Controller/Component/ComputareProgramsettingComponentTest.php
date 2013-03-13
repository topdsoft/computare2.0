<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareProgramsettingComponent', 'Controller/Component');

class ComputareProgramsettingComponentTest extends CakeTestCase {
	public $fixtures=array('app.programsetting');
	
	public function setUp() {
		parent::setUp();
		$this->Programsetting=ClassRegistry::init('Programsetting');
		$Collection = new ComponentCollection();
		$this->ComputareProgramsettingComponent=new ComputareProgramsettingComponent($Collection);
	}
	
	public function testSave() {
		//test saving program settings
	}
	
	public function testUpdatedb() {
		//test updating databse
	}
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareCustomerComponentTest