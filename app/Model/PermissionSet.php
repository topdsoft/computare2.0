<?php
App::uses('AppModel', 'Model');
/**
 * PermissionSet Model
 *
 * @property User $User
 * @property UserGroup $UserGroup
 * @property Form $Form
 * @property FormGroup $FormGroup
 */
class PermissionSet extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'permissionSets';


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
		'UserGroup' => array(
			'className' => 'UserGroup',
			'foreignKey' => 'userGroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'form_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FormGroup' => array(
			'className' => 'FormGroup',
			'foreignKey' => 'formGroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
