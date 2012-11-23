<?php
App::uses('AppModel', 'Model');
/**
 * Glaccount Model
 *
 * @property Glaccountdetail $Glaccountdetail
 * @property Glentry $Glentry
 */
class Glaccount extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'computare';

	public $displayField='name';

	public $virtualFields=array(
		'name'=>'select GlaccountDetail.name from glaccountDetails as GlaccountDetail where Glaccount.glaccountDetail_id=GlaccountDetail.id',
		'group'=>'select Glgroup.name from glgroups as Glgroup,glaccountDetails as GlaccountDetail where Glaccount.glaccountDetail_id=GlaccountDetail.id and Glgroup.id=GlaccountDetail.glgroup_id',
		);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'GlaccountDetail' => array(
			'className' => 'GlaccountDetail',
			'foreignKey' => 'glaccountDetail_id',
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
		'Glentry' => array(
			'className' => 'Glentry',
			'foreignKey' => 'glaccount_id',
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

}
