<?php
/**
 * ComputareSyseventComponent.php
 * 
 * Part of the computare accounting system used to log system events
 */

App::uses('Component','Controller');
class ComputareSyseventComponent extends Component{
	
	/**
	 * save method
	 * @param data array(
	 * 	'event_type'=>[1:error, 2:form validation, 3:login, 4:permissions, 5: new form,6: DB],
	 * 	'errorEvent'=>array(
	 * 		'message'=>string error message
	 * 	)
	 * )
	 * 
	 */
	public function save($data) {
		//get models
		$this->Sysevent=ClassRegistry::init('Sysevent');
		$this->Permissionevent=ClassRegistry::init('Permissionevent');
		$this->Errorevent=ClassRegistry::init('Errorevent');
		$this->Htmlevent=ClassRegistry::init('Htmlevent');
		$this->Formevent=ClassRegistry::init('Formevent');
		
		$dataSource=$this->Sysevent->getDataSource();
		//start transaction
		$ok=false;
		$dataSource->begin();
		//check error type
		if($data['event_type']==3) {
			/**login event:
			 * requires errorEvent=>array(
			 * 	'message' (should contain login failure. user:[attempted username])
			 * )
			 */
			$errorEvent=$data['errorEvent'];
			//insert errorevent
			$this->Errorevent->create();
			$ok=$this->Errorevent->save($errorEvent);
			//insert sysevent
			$sysevent=array();
			$sysevent['remoteaddr']=$_SERVER['REMOTE_ADDR'];
			$sysevent['event_type']=3;
			$sysevent['errorevent_id']=$this->Errorevent->getInsertId();
			if($ok)$ok=$this->Sysevent->save($sysevent);
		}
		
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
}