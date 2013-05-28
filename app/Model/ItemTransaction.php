<?php
App::uses('AppModel', 'Model');
/**
 * ItemTransaction Model
 *
 * @property Item $Item
 * @property Sale $Sale
 * @property Receipt $Receipt
 */
class ItemTransaction extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';
	public $order = 'ItemTransaction.id desc';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'itemTransactions';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Receipt' => array(
			'className' => 'Receipt',
			'foreignKey' => 'receipt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
