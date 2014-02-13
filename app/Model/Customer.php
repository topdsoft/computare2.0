<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 * @property CustomerDetail $CustomerDetail
 */
class Customer extends AppModel {

	public $virtualFields=array(
		'name'=>'if ((select companyName from customerDetails where customerDetails.id=Customer.customerDetail_id)!="",(select companyName from customerDetails where customerDetails.id=Customer.customerDetail_id), CONCAT((select lastName from customerDetails where customerDetails.id=Customer.customerDetail_id),", ",(select firstName from customerDetails where customerDetails.id=Customer.customerDetail_id)))',
	);
	public $displayField='name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CustomerDetail' => array(
			'className' => 'CustomerDetail',
			'foreignKey' => 'customerDetail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CustomerGroup' => array(
			'className' => 'CustomerGroup',
			'foreignKey' => 'customerGroup_id'
		)
	);
	
/**
 * hasMany associations
 */
	public $hasMany = array (
		'Address' => array (
			'className' => 'Address',
			'conditions' => array('Address.active'),
		),
		'Contact' => array(
			'conditions'=>array('Contact.active')
		)
	);
}
