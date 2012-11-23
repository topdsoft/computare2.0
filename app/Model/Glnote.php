<?php
App::uses('AppModel', 'Model');
/**
 * Glnote Model
 *
 * @property Glentry $Glentry
 */
class Glnote extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Glentry' => array(
			'className' => 'Glentry',
			'foreignKey' => 'glnote_id',
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
