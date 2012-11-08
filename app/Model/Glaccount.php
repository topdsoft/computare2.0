<?php
App::uses('AppModel', 'Model');
/**
 * Glaccount Model
 *
 * @property Glaccountdetail $Glaccountdetail
 * @property Glentry $Glentry
 */
class Glaccount extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Glaccountdetail' => array(
			'className' => 'Glaccountdetail',
			'foreignKey' => 'glaccountdetail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Glentry' => array(
			'className' => 'Glentry',
			'foreignKey' => 'glaccount_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
