<?php
App::uses('AppModel', 'Model');
/**
 * Glslot Model
 *
 * @property Glaccount $Glaccount
 */
class Glslot extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'slot';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Glaccount' => array(
			'className' => 'Glaccount',
			'foreignKey' => 'glaccount_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
