<?php
App::uses('AppModel', 'Model');
/**
 * Errorevent Model
 *
 * @property Sysevent $Sysevent
 */
class Errorevent extends AppModel {

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
		'Sysevent' => array(
			'className' => 'Sysevent',
			'foreignKey' => 'errorevent_id',
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
