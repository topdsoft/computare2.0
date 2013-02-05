<?php
App::uses('AppModel', 'Model');
/**
 * Sysevent Model
 *
 * @property Permissionevent $Permissionevent
 * @property Errorevent $Errorevent
 * @property Htmlevent $Htmlevent
 * @property Formevent $Formevent
 */
class Sysevent extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

	public $order = array('Sysevent.created desc');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Permissionevent' => array(
			'className' => 'Permissionevent',
			'foreignKey' => 'permissionevent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Errorevent' => array(
			'className' => 'Errorevent',
			'foreignKey' => 'errorevent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Htmlevent' => array(
			'className' => 'Htmlevent',
			'foreignKey' => 'htmlevent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Formevent' => array(
			'className' => 'Formevent',
			'foreignKey' => 'formevent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check if table exists
		$q=$this->query('show tables like "sysevents";');
debug($q);exit;
		if(!$q) {
			//create table
			$q=$this->query("
CREATE TABLE IF NOT EXISTS `sysevents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `created_id` int(10) unsigned DEFAULT NULL,
  `remoteaddr` varchar(20) NOT NULL,
  `event_type` smallint(6) NOT NULL,
  `permissionevent_id` int(10) unsigned DEFAULT NULL,
  `errorevent_id` int(10) unsigned DEFAULT NULL,
  `htmlevent_id` int(10) unsigned DEFAULT NULL,
  `formevent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='0' ;
			");
		}//endif
		#check table schema and make adjustments if necessary
//		$test=$this->query('select table_comment from INFORMATION_SCHEMA.TABLES');
		$q=$this->query('show table status where Name="sysevents"');
		$schema=$q[0]['TABLES']['Comment'];
		if($schema==='') {
			//schema not set
			$q=$this->query('alter table sysevents COMMENT="0"');
//debug($q);
		}//endif
//debug($schema);exit;
	}
	
	/**
	 * returns list of event types
	 */
	public function getEventTypes() {
		$list=array(
			1=>'Error',
			2=>'Form Validation',
			3=>'Login',
			4=>'Permissions Change',
			5=>'New Form/Report',
			6=>'DB Change'
		);
		return $list;
	}
}
