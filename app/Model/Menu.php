<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property Form $Form
 * @property User $User
 */
class Menu extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Virtual fields
 */
	public $virtualFields = array(
		'links'=>'select count(*) from forms_menus as FormsMenu where FormsMenu.menu_id=Menu.id',
		'users'=>'select count(*) from menus_users as MenusUser where MenusUser.menu_id=Menu.id'
		);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a display name for this menu.  It does not need to be unique.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Form' => array(
			'className' => 'Form',
			'joinTable' => 'forms_menus',
			'foreignKey' => 'menu_id',
			'associationForeignKey' => 'form_id',
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
			'joinTable' => 'menus_users',
			'foreignKey' => 'menu_id',
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

	public function addMenuToUser($menu_id,$user_id) {
		//adds a  menu to users menu
		$this->id=$menu_id;
		if(!$this->exists()) return false;
		$this->User->id=$user_id;
		if(!$this->User->exists()) return false;
		//check for menu already assigned
		if($this->MenusUser->find('first',array('conditions'=>array('user_id'=>$user_id,'menu_id'=>$menu_id)))) return false;
		//create new link using ordr=999.9
		$results=$this->MenusUser->save(array('id'=>null,'menu_id'=>$menu_id,'user_id'=>$user_id,'ordr'=>999.9));
		//now call cleanup code to put in correct order
		$this->cleanUpMenuOrder($user_id);
		return $results;
	}
	
	public function cleanUpMenuOrder($user_id) {
		//makes sure that users menu ordr values start with 1 and go up from there
		$this->User->id=$user_id;
		if(!$this->User->exists()) return false;
		$menus=$this->MenusUser->find('all',array('conditions'=>array('user_id'=>$user_id),'order'=>array('ordr')));
		$i=0;
		foreach($menus as $menu) {
			//step through all menu items and check ordr
			$i++;
			if($menu['MenusUser']['ordr']!=$i) {
				//reset ordr value
				$menu['MenusUser']['ordr']=$i;
				$this->MenusUser->save($menu);
			}
		}
	}
}
