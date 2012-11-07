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
 * 	'id'=>name of the help file (do not include .ctp)
 * 	'name'=>The display name for the page
 * 	'anchors'=>array list of minor headings in page (may be empty)
 * )
 */
	public $data= array(
		array('id'=>'customers','name'=>'Customers','anchors'=>array(
			'Adding a New Customer','Editing a Customer','Deleting a Customer')),
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