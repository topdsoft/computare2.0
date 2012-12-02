<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Auth', 'Session', 'Cookie');

	public function beforeFilter() {
		//set which database to use
		$db=$this->Session->read('Company');
//debug($db);
		Configure::write('Company',$db);
		$this->Auth->authError="Your Session Has Expired";
	}
	
	public function beforeRender() {
		//no ACL on login or help pages
		$ignore=array('display','login');
		if(!in_array($this->params['action'],$ignore)) {
			$formOBJ=ClassRegistry::init('Form');
			//look for controller/action combo in forms table
			$form=$formOBJ->find('first',array('conditions'=>array('controller'=>$this->params['controller'],'action'=>$this->params['action'])));
			if(!$form) {
				//form is not in table, so has never been visited
				if(isset($this->viewVars['formName'])) $formName=$this->viewVars['formName'];
				else $formName='**FORM NAME NOT SET';
				//save new form
				$form= array(
					'id'=>null,
					'created_id'=>$this->Auth->user('id'),
					'name'=>$formName,
					'controller'=>$this->params['controller'],
					'action'=>$this->params['action']
				);
				$formOBJ->create();
				$formOBJ->save($form);
			}//endif
			//get help index if set
			if(isset($form['Form']['helplink']) && !empty($form['Form']['helplink'])) $this->set('formhelp',$form['Form']['helplink']);
		}//endif
//debug($form);exit;
	}
	
	/**
	 * _filterRedirect function
	 * 
	 * When returning to controller from user clicking 'Set Filter',
	 * call this function to parse the results of the filter selections.
	 * it will redirect back to the view with the params set in named variables
	 * Is called from _useFilter, but can also be used directly for more control
	 */
	protected function _filterRedirect() {
		//get data from request and add it to passedArgs
		foreach($this->filterData as $filter) {
			//loop for each filter and set the passedArg to the value returned from the form
			$this->passedArgs[$filter['passName']]=$this->request->data['Filter'][$filter['passName']];
		}//end foreach
//debug($this->request->data);exit;
		$this->redirect($this->passedArgs);
	}//end protected function _filterRedirect
	
	/**
	 * _setCondidtions function
	 * 
	 * Will set the controllers conditions based on values in named varaibles
	 * Is called from _useFilter, but can also be used directly for more control
	 */
	protected function _setCondidtions() {
		//setup array of conditions for pagination
		$this->conditions=array();
		foreach($this->filterData as $filter) {
			//loop for each requested filter
			if($filter['type']==1) {
				//listbox filter
				if(isset($this->passedArgs[$filter['passName']]) && !empty($this->passedArgs[$filter['passName']])) {
					//has been passed
					$this->conditions[]=array($filter['field']=>$this->passedArgs[$filter['passName']]);
//debug($this->conditions);exit;
				}//endif
			}//endif
			if($filter['type']==2) {
				//range
				if(isset($this->passedArgs[$filter['passName']]['min']) && !empty($this->passedArgs[$filter['passName']]['min'])) {
					//min is set
					$this->conditions[]=array($filter['field'].' >='=>$this->passedArgs[$filter['passName']]['min']);
				}//endif
				if(isset($this->passedArgs[$filter['passName']]['max']) && !empty($this->passedArgs[$filter['passName']]['max'])) {
					//max is set
					$this->conditions[]=array($filter['field'].' <='=>$this->passedArgs[$filter['passName']]['max']);
				}//endif
			}//endif
			if($filter['type']==4) {
				//TF checkbox
				if(isset($this->passedArgs[$filter['passName']]) && $this->passedArgs[$filter['passName']]) {
					//true
					$this->conditions[]=$filter['trueCondition'];
				} else {
					//false
					$this->conditions[]=$filter['falseCondition'];
				}//endif
			}//end type==4 TF
		}//endforeach
	}
	
	/**
	 * _setData function
	 * 
	 * used to set data that is shown in the view filter controls
	 * Is called from _useFilter, but can also be used directly for more control
	 */
	protected function _setData() {
		//set data for form inputs
		foreach($this->filterData as $filter) {
			//loop for each requested filter
			if(isset($this->passedArgs[$filter['passName']])) $this->request->data['Filter'][$filter['passName']]=$this->passedArgs[$filter['passName']];
			else $this->request->data['Filter'][$filter['passName']]=null;
		}//endforeach
	}
	
	/**
	 * _setFilters function
	 * 
	 * used to set up what fitlers will be shown to the user
	 * @params $filterData  (see _useFilter for details)
	 * Is called from _useFilter, but can also be used directly for more control
	 */
	protected function _setFilters($filterData) {
		//store filterData
		$this->filterData=$filterData;
		//pass array to view (so it can be used when calling element)
		$this->set('filterData',$filterData);
	}
	
	/**
	 * _useFilter function
	 * 
	 * This function provies an easy interface for filtering pagination results
	 * it should be called from the controller before the pagination is used in a set
	 * if $this->request->data is set then it will parse the users request and redirect back to the page with named parameters
	 * if not set it will use named parameters to setup the conditions array for the desired results
	 * 
	 * @params $filterData:
	 * 	array of filters to use
	 * 	each must include:
	 * 		type=>[1-4]
	 * 		passName=>name used in url to pass varaibles, must be unique to form
	 * 		label=>display label
	 * 
	 * #types:
	 * type==1: List (list box with multiple selects):
	 * 	options=>array of options to use in list box
	 * 	field=>field for comparison (EX:Customers.group_id)
	 * 
	 * type==2: Value (range of numeric values):
	 * 	field=>field for comparison (EX:Glentry.debit)
	 * 
	 * type==3: Date (date range):
	 * 
	 * type==4: T/F checkbox (checkbox with conditions for t or f):
	 * 	trueCondition=>sql logic when box is checked (can be empty)
	 * 	falseCondition=>sql logic when box is not checked (can be empty)
	 */
	protected function _useFilter($filterData) {
		//setup filters
		$this->_setFilters($filterData);
		//check for request
		if($this->request->is('post') || $this->request->is('put')) {
			//redirect to page using named parameters to set filter data
			$this->_filterRedirect();
		} else {
			//set conditions for pagination
			$this->_setCondidtions();
			//set data for view to use
			$this->_setData();
		}//endif
	}//end protected function _useFilter
}
