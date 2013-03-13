<?php
/**
 * ComputareProgramsettingComponent.php
 * 
 * Part of computare accounting system used to modify users and usergroups
 * */

App::uses('Component','Controller');
class ComputareProgramsettingComponent extends Component{
	/**
	 * save method
	 * @param data
	 * 
	 */
	public function save($data) {
		//get models
		$this->Programsetting=ClassRegistry::init('Programsetting');
		$ok=true;
		$dataSource=$this->Programsetting->getDataSource();
		//start transaction
		$dataSource->begin();
		//save data
		$this->Programsetting->create();
		$ok=$this->Programsetting->save($data);
		if($ok)$dataSource->commit();
		else $dataSource->rollback();
		return ($ok==true);
	}//end public function save
	
	/**
	 * updatedb method
	 * used to check and update to the current database structure when adding a new table
	 * @param $uid user's id who is updating
	 * @return -1 fail, 0 allready up to date, other is new dbschema
	 */
	public function updatedb($uid) {
		//latest schema
		$latest=0;
		//get models
		$this->Programsetting=ClassRegistry::init('Programsetting');
		$settings=$this->Programsetting->find('first', array('order'=>array('Programsetting.created'=>'desc')));
		if($latest==$settings['Programsetting']['dbschema']) return 0;
debug($settings);exit;
	}
}