<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrderDetail Model
 *
 * @property SalesOrder $SalesOrder
 * @property Item $Item
 * @property Service $Service
 */
class SalesOrderDetail extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'salesOrderDetails';

	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check table schema and make adjustments if necessary
		$dbs=$this->getSechema();
		$ok=true;
		if($ok && $dbs<1) {
			try {$this->query('ALTER TABLE  `salesOrderDetails` ADD  `timeRecord_id` INT UNSIGNED NULL AFTER  `service_id` ;');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(1);
			else $this->logDBFailure($e);
		}
		if($ok && $dbs<2) {
			try {$this->query('ALTER TABLE  `salesOrderDetails` CHANGE `removed` `removed` DATETIME NULL DEFAULT NULL ;');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(2);
			else $this->logDBFailure($e);
		}
		if($ok && $dbs<3) {
			try {$this->query('ALTER TABLE  `salesOrderDetails` CHANGE `removed_id` `removed_id` INT( 10 ) UNSIGNED NULL DEFAULT NULL ;');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(3);
			else $this->logDBFailure($e);
		}
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'qty' => array(
			'comparison' => array(
				'rule' => array('comparison','>',0),
				'message' => 'Please enter a qty greather than 0 here',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SalesOrder' => array(
			'className' => 'SalesOrder',
			'foreignKey' => 'salesOrder_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'service_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TimeRecord' => array(
			'className' => 'TimeRecord',
			'foreignKey' => 'timeRecord_id',
		)
	);
}
