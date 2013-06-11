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


	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
