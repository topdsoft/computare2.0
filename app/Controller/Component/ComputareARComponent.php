<?php
/**
 * ComputareARComponent.php
 * 
 * Part of computare accounting system used to edit accounts receivable
 * */

App::uses('Component','Controller');
class ComputareARComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie');
	
	/**
	 * method saveSO
	 * @param array $data
		* For a new SO:
		* $data['SalesOrder']['customer_id'] (required)
		* $data['SalesOrder']['salesOrderType_id'] (required)
		* 
		* For existing SO:
		* $data['SalesOrder']['id'] (required)
		* $data['SalesOrder']['status']=='O' can be changed to
		* $data['SalesOrder']['status']=>'V' to void or
		* $data['SalesOrder']['status']=>'C' to close
	 * @returns t/f
	 */
	public function saveSO($data) {
		//save so data
		$this->SalesOrder=ClassRegistry::init('SalesOrder');
		$this->Customer=ClassRegistry::init('Customer');
		$this->SalesOrderType=ClassRegistry::init('SalesOrderType');
		//validation
		$ok=true;
		if(!isset($data['SalesOrder'])) return false;
		if(isset($data['SalesOrder']['id'])) {
			//existing SO
			unset($data['SalesOrder']['customer_id']);
			unset($data['SalesOrder']['salesOrderType_id']);
			$SO=$this->SalesOrder->read(null,$data['SalesOrder']['id']);
			if($SO) {
				//found ok
				if($SO['SalesOrder']['status']!='O') $ok=false;
				unset($SO);
			} else $ok=false;
// debug($ok);debug($data);exit;
		} else {
			//new SO
			if(!isset($data['SalesOrder']['customer_id'])) return false;
			$this->Customer->id=$data['SalesOrder']['customer_id'];
// debug($this->Customer->field('name'));
			if(!$this->Customer->field('active')) {
				$ok=false;
			}//endif
			if(!isset($data['SalesOrder']['salesOrderType_id'])) return false;
			$this->SalesOrderType->id=$data['SalesOrder']['salesOrderType_id'];
			if(!$this->SalesOrderType->field('active')) {
				$ok=false;
			}//endif
			$data['SalesOrder']['created_id']=$this->Auth->user('id');
			$data['SalesOrder']['status']='O';
			if($ok) $this->SalesOrder->create();
		}//endif
		$dataSource=$this->Customer->getDataSource();
		//start transaction
		$dataSource->begin();
		if(isset($data['SalesOrder']['id'])) {
			if($data['SalesOrder']['status']=='C') {
				//clsoe sales order
				$data['SalesOrder']['closed']=date('Y-m-d h:m:s');
				$data['SalesOrder']['closed_id']=$this->Auth->user('id');
			}//endif
			if($data['SalesOrder']['status']=='V') {
				//void sales order
				$data['SalesOrder']['voided']=date('Y-m-d h:m:s');
				$data['SalesOrder']['voided_id']=$this->Auth->user('id');
			}//endif
		}//endif
		if($ok) $ok=$this->SalesOrder->save($data);
		if($ok) $dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function saveSO
	
	/**
	 * method saveline
	 * @param array $data
	 * @returns t/f
	 */
	public function saveline($data) {
		//save item or service line
		
	}//end public function saveline
	
	
	
}