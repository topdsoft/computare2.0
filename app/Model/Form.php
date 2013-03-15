<?php
App::uses('AppModel', 'Model');
/**
 * Form Model
 *
 * @property Group $Group
 * @property Menu $Menu
 * @property User $User
 */
class Form extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $order = array('type','controller','action');

	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check table schema and make adjustments if necessary
		$dbs=$this->getSechema();
		$ok=true;
		if($ok && $dbs<1) {
			//add formGroup_id 2013-3-15
//NEED ERROR CATCH HERE
			$this->query("ALTER TABLE  `".$this->table."` ADD  `formGroup_id` INT UNSIGNED NULL AFTER  `created_id`");
			if($ok) $this->setSchema(1);
		}//endif
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 */
	public $belongsTo = array (
		'FormGroup' => array(
			'className' => 'FormGroup',
			'foreignKey' => 'formGroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			
		),
	);
/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'UserGroup' => array(
			'className' => 'UserGroup',
			'joinTable' => 'forms_groups',
			'foreignKey' => 'form_id',
			'associationForeignKey' => 'group_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Menu' => array(
			'className' => 'Menu',
			'joinTable' => 'forms_menus',
			'foreignKey' => 'form_id',
			'associationForeignKey' => 'menu_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'joinTable' => 'forms_users',
			'foreignKey' => 'form_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
