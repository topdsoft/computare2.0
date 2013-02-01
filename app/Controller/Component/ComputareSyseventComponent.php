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
		//check event type
		if($data['event_type']==1) {
			/**general error:
			 */
		}//endif
		if($data['event_type']==2) {
			/**form validation error
			 */
		}//endif
		if($data['event_type']==3) {
			/**login event:
			 * requires errorEvent=>array(
			 * 	'message' (should contain login failure. user:[attempted username] or null for successfull login)
			 * )
			 */
			if(isset($data['errorEvent'])) {
				// failed login
				$errorEvent=$data['errorEvent'];
				//insert errorevent
				$this->Errorevent->create();
				$ok=$this->Errorevent->save($errorEvent);
				$errorevent_id=$this->Errorevent->getInsertId();
			} else {
				// login ok
				$errorevent_id=null;
				$ok=true;
			}//endif
			//insert sysevent
			$sysevent=array();
			$sysevent['remoteaddr']=$_SERVER['REMOTE_ADDR'];
			$sysevent['event_type']=3;
			$sysevent['errorevent_id']=$errorevent_id;
			if($ok)$ok=$this->Sysevent->save($sysevent);
		}//endif
		if($data['event_type']==4) {
			/**permissions change
			 */
		}//endif
		if($data['event_type']==5) {
			/**new form available
			 */
		}//endif
		if($data['event_type']==6) {
			/**DB changes
			 */
		}
			
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
}