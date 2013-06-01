<?php
App::uses('AppModel', 'Model');
/**
 * Location Model
 *
 * @property LocationDetail $LocationDetail
 * @property Location $ParentLocation
 * @property LocationDetail $LocationDetail
 * @property Location $ChildLocation
 * @property Item $Item
 */
class Location extends AppModel {
    public $actsAs = array('Tree');
    public $displayField = 'name';
//     public $order = 'lft';
/*	public $virtualFields = array(
		'name'=>'select name from locationDetails as LocationDetail where LocationDetail.id=Location.locationDetail_id'
	);*/

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['name'] = 'select name from locationDetails as LocationDetail where LocationDetail.id='.$this->alias.'.locationDetail_id';
		$this->order = $this->alias.'.lft';
	}

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
		'LocationDetail' => array(
			'className' => 'LocationDetail',
			'foreignKey' => 'locationDetail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentLocation' => array(
			'className' => 'Location',
			'foreignKey' => 'parent_id',
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
		'LocationDetail' => array(
			'className' => 'LocationDetail',
			'foreignKey' => 'location_id',
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
		'ChildLocation' => array(
			'className' => 'Location',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'lft',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'InventoryLock' => array(
			'className' => 'InventoryLock',
			'foreignKey' => 'location_id',
			'dependent' => false,
			'conditions' => 'InventoryLock.active'
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Item' => array(
			'className' => 'Item',
			'joinTable' => 'items_locations',
			'foreignKey' => 'location_id',
			'associationForeignKey' => 'item_id',
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
