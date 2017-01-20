<?php
App::uses('AppModel', 'Model');
/**
 * TimeRecord Model
 *
 * @property User $User
 * @property Task $Task
 */
class TimeRecord extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'timeRecords';

	public $order = 'TimeRecord.id desc';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check table schema and make adjustments if necessary
		$dbs=$this->getSechema();
		$ok=true;
		if($ok && $dbs<1) {
			try {$this->query('ALTER TABLE  `timeRecords` ADD  `notes` TEXT NULL DEFAULT NULL ;');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(1);
			else $this->logDBFailure($e);
		}
	}

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'task_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
