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
		$latest=4;
		//get models
		$this->Programsetting=ClassRegistry::init('Programsetting');
		$settings=$this->Programsetting->find('first', array('order'=>array('Programsetting.created'=>'desc')));
		if($latest==$settings['Programsetting']['dbschema']) return 0;
		$ok=true;
		#dbschema==1
		if($settings['Programsetting']['dbschema']<1) {
			//add formGroups table
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `formGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
//NEED ERROR CATCH HERE
			if($ok) $settings['Programsetting']['dbschema']=1;
//NEED LOGGING HERE
		}//endif 1
		
		#dbschema==2
		if($settings['Programsetting']['dbschema']<2) {
			//add permissionSets table
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `permissionSets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `userGroup_id` int(10) unsigned DEFAULT NULL,
  `form_id` int(10) unsigned DEFAULT NULL,
  `formGroup_id` int(10) unsigned DEFAULT NULL,
  `view` tinyint(1) NOT NULL,
  `submit` tinyint(1) NOT NULL,
  `setDefault` tinyint(1) NOT NULL,
  `setLogging` tinyint(1) NOT NULL,
  `undoOwn` tinyint(1) NOT NULL,
  `undoOthers` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`user_id`),
  KEY (`userGroup_id`),
  KEY (`form_id`),
  KEY (`formGroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
//NEED ERROR CATCH HERE
			if($ok) $settings['Programsetting']['dbschema']=2;
//NEED LOGGING HERE
		}//endif 2
		
		#dbschema==3
		if($settings['Programsetting']['dbschema']<3) {
			//change permissionevents table to permissionEvents
			$this->Programsetting->query("DROP TABLE IF EXISTS `permissionevents`;");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `permissionEvents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `userGroup_id` int(10) unsigned DEFAULT NULL,
  `form_id` int(10) unsigned DEFAULT NULL,
  `formGroup_id` int(10) unsigned DEFAULT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
//NEED ERROR CATCH HERE
			if($ok) $settings['Programsetting']['dbschema']=3;
//NEED LOGGING HERE
		}//endif 3
		
		#dbschema==4
		if($settings['Programsetting']['dbschema']<4) {
			//add tables for lists
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `listTemplates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `removed` datetime DEFAULT NULL,
  `removed_id` int(10) unsigned DEFAULT NULL,
  `newList_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `linkedTo_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `listQuestions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `rank` smallint(6) NOT NULL,
  `label` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `listTemplate_id` int(10) unsigned NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `listTemplate_id` (`listTemplate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_id` int(10) unsigned DEFAULT NULL,
  `listTemplate_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `purchaseOrder_id` int(10) unsigned NOT NULL,
  `salesOrder_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `listTemplate_id` (`listTemplate_id`),
  KEY `customer_id` (`customer_id`),
  KEY `purchaseOrder_id` (`purchaseOrder_id`),
  KEY `salesOrder_id` (`salesOrder_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `listIntAnswers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `list_id` int(10) unsigned NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `listFloatAnswers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `list_id` int(10) unsigned NOT NULL,
  `answer` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `listVarcharAnswers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `list_id` int(10) unsigned NOT NULL,
  `answer` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
			$this->Programsetting->query("
CREATE TABLE IF NOT EXISTS `listTextAnswers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  `list_id` int(10) unsigned NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
//NEED ERROR CATCH HERE
			if($ok) $settings['Programsetting']['dbschema']=4;
//NEED LOGGING HERE
		}//endif dbschema==4
		
		$settings['Programsetting']['created_id']=$uid;
		if($ok) $ok=$this->save($settings);
		if($ok===true) return $settings['Programsetting']['dbschema'];
		else return -1;
//debug($settings);exit;
	}
}