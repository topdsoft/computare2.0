<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrderType Model
 *
 */
class SalesOrderType extends AppModel {

	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		#check table schema and make adjustments if necessary
		$dbs=$this->getSechema();
		$ok=true;
		if($ok && $dbs<1) {
			//add field for issueType_id
			try {$this->query('ALTER TABLE  `salesOrderTypes` ADD  `issueType_id` INT UNSIGNED NOT NULL');}
			catch (Exception $e) {$ok=false;}
			if($ok) $this->setSchema(1);
			else $this->logDBFailure($e);
		}//endif
	}
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'salesOrderTypes';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Glaccount',
		'IssueType' => array(
			'foreignKey' => 'issueType_id'
		)
	);

/**
 * hasMany associations
 */
	public $hasMany = array(
		'SalesOrderFee' => array(
			'className' => 'SalesOrderFee',
			
		),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter a name here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
/*		'shipping' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
	);
}
