<?php
App::uses('AppModel', 'Model');
/**
 * Formevent Model
 *
 * @property Sysevent $Sysevent
 */
class Formevent extends AppModel {

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
			'foreignKey' => 'formevent_id',
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
