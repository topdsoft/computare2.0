<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property ItemCost $ItemCost
 * @property ItemDetail $ItemDetail
 * @property ItemSerialNumber $ItemSerialNumber
 * @property ItemTransaction $ItemTransaction
 * @property PurchaseOrderDetail $PurchaseOrderDetail
 * @property Receipt $Receipt
 * @property Sale $Sale
 * @property SalesOrderDetail $SalesOrderDetail
 * @property Customer $Customer
 * @property Group $Group
 * @property Image $Image
 * @property Location $Location
 * @property Vendor $Vendor
 */
class Item extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';
	public $displayField = 'name';

	public $virtualFields = array(
		'name'=>'select name from itemDetails as ItemDetail where ItemDetail.id=Item.itemDetail_id',
		'qty'=>'select sum(qty) from items_locations where items_locations.item_id=Item.id'
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * belongsTo associations
 */

	public $belongsTo = array(
		'ItemDetail' => array (
			'className' => 'ItemDetail',
			'foreignKey' => 'itemDetail_id',
		),
		'ItemCategory' => array (
			'className' => 'ItemCategory',
			'foreignKey' => 'category_id'
		),
	);
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
/*		'ItemDetail' => array(
			'className' => 'ItemDetail',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('ItemDetail.id'=>'desc'),
			'limit' => '1',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),//*/
		'ItemCost' => array(
			'className' => 'ItemCost',
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
		'Revisions' => array(
			'className' => 'ItemDetail',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('Revisions.id'=>'desc'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ItemSerialNumber' => array(
			'className' => 'ItemSerialNumber',
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
			'order' => array('ItemTransaction.created'=>'desc'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PurchaseOrderDetail' => array(
			'className' => 'PurchaseOrderDetail',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => array('PurchaseOrderDetail.active'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Receipt' => array(
			'className' => 'Receipt',
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
		'Sale' => array(
			'className' => 'Sale',
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
		'SalesOrderDetail' => array(
			'className' => 'SalesOrderDetail',
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
		'Customer' => array(
			'className' => 'Customer',
			'joinTable' => 'customers_items',
			'foreignKey' => 'item_id',
			'associationForeignKey' => 'customer_id',
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
		'ItemGroup' => array(
			'className' => 'ItemGroup',
			'joinTable' => 'groups_items',
			'foreignKey' => 'item_id',
			'associationForeignKey' => 'itemGroup_id',
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
		),
		'Vendor' => array(
			'className' => 'Vendor',
			'joinTable' => 'items_vendors',
			'foreignKey' => 'item_id',
			'associationForeignKey' => 'vendor_id',
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
