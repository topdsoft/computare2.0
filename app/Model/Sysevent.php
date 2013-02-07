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
		#check table schema and make adjustments if necessary
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
