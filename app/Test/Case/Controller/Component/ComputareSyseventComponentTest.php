<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('ComputareSyseventComponent', 'Controller/Component');

class ComputareSyseventComponentTest extends CakeTestCase {
	public $fixtures=array('app.sysevent','app.permissionevent','app.errorevent','app.htmlevent');
	
	public function setUp() {
		parent::setUp();
		$this->Sysevent=ClassRegistry::init('Sysevent');
		$this->Permissionevent=ClassRegistry::init('Permissionevent');
		$this->Errorevent=ClassRegistry::init('Errorevent');
		$this->Htmlevent=ClassRegistry::init('Htmlevent');
		$Collection = new ComponentCollection();
		$this->ComputareSyseventComponent=new ComputareSyseventComponent($Collection);
	}
	
	public function testSave() {
	}
	
	
	public function tearDown() {
		parent::tearDown();
	}
}//end class ComputareCustomerComponentTest