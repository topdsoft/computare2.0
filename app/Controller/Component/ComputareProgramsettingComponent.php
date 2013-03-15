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
		unset($data['Programsetting']['id']);
		unset($data['Programsetting']['created']);
//debug($data);exit;
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
		$latest=1;
		//get models
		$this->Programsetting=ClassRegistry::init('Programsetting');
		$settings=$this->Programsetting->find('first', array('order'=>array('Programsetting.created'=>'desc')));
		if($latest==$settings['Programsetting']['dbschema']) return 0;
		$ok=true;
		#dbschema==1
		if($settings['Programsetting']['dbschema']<1) {
			//add formGroups table
			$this->Programsetting->query(
				"CREATE TABLE IF NOT EXISTS `formGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
"
			);
//NEED ERROR CATCH HERE
			if($ok) $settings['Programsetting']['dbschema']=1;
//NEED LOGGING HERE
		}//endif 1
		$settings['Programsetting']['created_id']=$uid;
		if($ok) $ok=$this->save($settings);
		if($ok===true) return $settings['Programsetting']['dbschema'];
		else return -1;
//debug($settings);exit;
	}
}