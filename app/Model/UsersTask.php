<?php
App::uses('AppModel', 'Model');
/**
 * UsersTask Model
 *
 * @property User $User
 * @property Task $Task
 */
class UsersTask extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public function beforeSave($options = array()) {
		//mod saved data
debug($this->data);exit;
		
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
