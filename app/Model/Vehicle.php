<?php
App::uses('AppModel', 'Model');
/**
 * Vehicle Model
 *
 * @property Customer $Customer
 * @property File $File
 * @property VehicleNote $VehicleNote
 * @property VehicleVisit $VehicleVisit
 * @property Image $Image
 */
class Vehicle extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check table schema and make adjustments if necessary
		$dbs=$this->getSechema();
		$ok=true;
		if($ok && $dbs<1) {
			//change vehicle_id from zero filled to not ZF
			try {$this->query('ALTER TABLE `vehicles` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(1);
			else $this->logDBFailure($e);
		}
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter a basic vehicle description here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
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
	/*	'File' => array(
			'className' => 'File',
			'foreignKey' => 'vehicle_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		'VehicleNote' => array(
			'className' => 'VehicleNote',
			'foreignKey' => 'vehicle_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'VehicleVisit' => array(
			'className' => 'VehicleVisit',
			'foreignKey' => 'vehicle_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'VehicleVisit.id DESC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Image' => array(
			'className' => 'Image',
			'joinTable' => 'images_vehicles',
			'foreignKey' => 'vehicle_id',
			'associationForeignKey' => 'image_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
