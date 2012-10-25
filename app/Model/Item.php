<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property ItemDetail $ItemDetail
 * @property ItemSNumber $ItemSNumber
 * @property ItemTransaction $ItemTransaction
 * @property Image $Image
 * @property Location $Location
 */
class Item extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ItemDetail' => array(
			'className' => 'ItemDetail',
			'foreignKey' => 'itemDetail_id',
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
		'ItemSerNumber' => array(
			'className' => 'ItemSerNumber',
			'foreignKey' => 'item_id',
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
		'ItemTransaction' => array(
			'className' => 'ItemTransaction',
			'foreignKey' => 'item_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Image' => array(
			'className' => 'Image',
			'joinTable' => 'images_items',
			'foreignKey' => 'item_id',
			'associationForeignKey' => 'image_id',
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
		'Location' => array(
			'className' => 'Location',
			'joinTable' => 'items_locations',
			'foreignKey' => 'item_id',
			'associationForeignKey' => 'location_id',
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
