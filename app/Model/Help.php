<?php

App::uses('AppModel', 'Model');
/**
 * Help Model
 *
 * The help model is used to build an index page for individual help pages in computare
 * Each help page should be kept in the app/View/Pages/ folder
 * Images should be kept in app/webroot/img/Help/
 * Index data is in the data array below
 */
class Help extends AppModel{

	public $useTable=false;

/**
 * $data stores the list of help pages in the following form
 * array(
 * 	'id'=>name of the help file (do not include .ctp)  NOTE: try to keep same as controller
 * 	'name'=>The display name for the page
 * 	'anchors'=>array list of minor headings in page (may be empty)
 * )
 * 
 * anchor standard ordering:  list, add, view, edit, delete
 * NOTE: anchor array offsets do not need to be defined, but if left undefined and the order changes, the anchor should be changed in both the controller help file definition and the forms table
 */
	public $data= array(
#SETUP--------------------------------------------------------------------------------------------------------------------
		array('id'=>'backups','name'=>'Backups','anchors'=>array(
			'l'=>'List Backups','a'=>'New Backup')),
			
		array('id'=>'forms','name'=>'Forms','anchors'=>array(
			'l'=>'List Forms','e'=>'Edit Form')),
			
		array('id'=>'formGroups','name'=>'Form Groups','anchors'=>array(
			'l'=>'List Form Groups','a'=>'Add Form Group')),
#AR-----------------------------------------------------------------------------------------------------------------------
		array('id'=>'customers','name'=>'Customers','anchors'=>array(
			'lc'=>'Listing Customers','a'=>'Adding a New Customer','v'=>'Viewing a Customer','ec'=>'Editing a Customer','ecp'=>'Editing Customer Pricing','dc'=>'Deleting a Customer')),
		
		array('id'=>'customerGroups','name'=>'Customer Groups','anchors'=>array(
			'l'=>'List Customer Groups','a'=>'Add Customer Group','v'=>'View Customer Group','e'=>'Edit Customer Group')),
			
		array('id'=>'salesOrders','name'=>'Sales Orders', 'anchors'=>array(
			'l'=>'List Sales Orders','a'=>'New Sales Order','e'=>'Edit Sales Order','v'=>'Voiding a Sales Order','c'=>'Closing a Sales Order')),
			
		array('id'=>'salesOrderTypes','name'=>'Sales Order Types', 'anchors'=>array(
			'l'=>'List Sales Order Types','a'=>'Add Sales Order Type','e'=>'Edit Sales Order Type')),
			
		array('id'=>'services','name'=>'Services','anchors'=>array(
			'l'=>'List Services','a'=>'Add Service')),
			
#GL---------------------------------------------------------------------------------------------------------------------
			array('id'=>'glslots','name'=>'Edit GL Account Conections','anchors'=>array(
			'Receive Inventory','Pay Invoice','Issue Inventory','Sale on Account','Cash Sale','All Sales')),
	);
	
/**
 * get function
 * @param string $id=id to lookup
 * @return array with data or null
 */
	public function get($id) {
		$toreturn=null;
		foreach($this->data as $i=>$data) {
			//loop through all data
			if($data['id']==$id) {
				//found
				$toreturn=$data;
				//build anchors
				foreach($toreturn['anchors'] as $ai=>$a) $toreturn['anchors'][$ai]="<br><br><a name=\"$ai\"></a><h3>{$toreturn['anchors'][$ai]}</h3>";
				//look for previous
				if(isset($this->data[$i-1]))$toreturn['prev']=$this->data[$i-1];
				else $toreturn['prev']=null;
				//look for next
				if(isset($this->data[$i+1]))$toreturn['next']=$this->data[$i+1];
				else $toreturn['next']=null;
			}
		}
		return $toreturn;
	}

}//end class Help