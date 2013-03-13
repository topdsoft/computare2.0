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
	 * 	'title', [shows on lists and index pages]
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
		$ok=true;
		$dataSource->begin();
		$sysevent=array();
		//check event type
		if($data['event_type']==1) {
			/**general error:
			 */
			if(isset($data['errorEvent'])) {
				//save error data
				$errorEvent=$data['errorEvent'];
				$this->Errorevent->create();
				if($ok)$ok=$this->Errorevent->save($errorEvent);
				if($ok)$errorevent_id=$this->Errorevent->getInsertId();
			} else $errorevent_id=null;
			if(isset($data['formEvent'])) {
				//save form data
				$formEvent=$data['formEvent'];
				$this->Formevent->create();
				if($ok)$ok=$this->Formevent->save($formEvent);
				if($ok)$formevent_id=$this->Formevent->getInsertId();
			} else $formevent_id=null;
			//set general sysevent values
			$sysevent['event_type']=1;
			$sysevent['errorevent_id']=$errorevent_id;
			$sysevent['formevent_id']=$formevent_id;
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
			//set general sysevent values
//			$sysevent=array();
//			$sysevent['remoteaddr']=$_SERVER['REMOTE_ADDR'];
			$sysevent['event_type']=3;
			$sysevent['errorevent_id']=$errorevent_id;
//			if($ok)$ok=$this->Sysevent->save($sysevent);
		}//endif
		if($data['event_type']==4) {
			/**permissions change
			 * requires permissionEvent=>array(
			 * 	'user_id'=>user id who got or lost permission
			 * 	'group_id'=>group id that got or lost permission
			 * 	'controller'=>permission given or taken from all of controller
			 * 	'form_id'=>form where permission given or taken
			 * )
			 */
			if(isset($data['permissionEvent'])) {
				//save permissionEvent
				$this->Permissionevent->create();
				$ok=$this->Permissionevent->save($data['permissionEvent']);
				if($ok) $sysevent['permissionevent_id']=$this->Permissionevent->getInsertId();
				$sysevent['event_type']=4;
			} else $ok=false;
		}//endif
		if($data['event_type']==5) {
			/**new form available
			 */
		}//endif
		if($data['event_type']==6) {
			/**DB changes
			 */
		}
		//insert sysevent
		$sysevent['remoteaddr']=$_SERVER['REMOTE_ADDR'];
		if(isset($data['title'])) $sysevent['title']=$data['title'];
		if($ok)$ok=$this->Sysevent->save($sysevent);
		//go-no go
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}
}