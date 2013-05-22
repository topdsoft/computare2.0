<?php
App::uses('AppModel', 'Model');
/**
 * InvoiceDetail Model
 *
 * @property Invoice $Invoice
 */
class InvoiceDetail extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'invoiceDetails';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
