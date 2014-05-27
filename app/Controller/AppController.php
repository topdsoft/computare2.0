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
	public $components = array('Auth', 'Session', 'Cookie','ComputareUser');
	private $actionsArray;

	public function beforeFilter() {
		//set which database to use
		$db=$this->Session->read('Company');
//debug($db);
		Configure::write('Company',$db);
		$this->Auth->authError="Your Session Has Expired";
	}
	
	public function beforeRender() {
		#error handling
		$error=false;
		if($this->name=='CakeError') {
			//error has occured
			$error=true;
			$errorData['event_type']=1;
			$errorData['created_id']=$this->Auth->user('id');
			if(isset($this->viewVars['code']))$errorData['title']='Error:'.$this->viewVars['code'];
			else $errorData['title']='Error:'.$this->viewVars['name'];
// debug($this->viewVars);exit;
			$errorData['errorEvent']=array('message'=>$this->viewVars['name']);
			$errorData['formEvent']=array(
				'controller'=>$this->request->params['controller'],
				'action'=>$this->request->params['action'],
				'parameters'=>$this->request->url,
				'created_id'=>$this->Auth->user('id')
			);
// debug($this);exit;
			$this->ComputareSysevent->save($errorData);
		}//endif
		//no ACL on login, popup, addFirstUser or help pages
		$ignore=array('display','login','popup','addFirstUser');
		if(!$error && !in_array($this->params['action'],$ignore)) {
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
				if(isset($this->viewVars['helplink'])) $form['helplink']=$this->viewVars['helplink'];
				if(isset($this->viewVars['add_menu'])) $form['add_menu']=$this->viewVars['add_menu'];
				//this should catch either
				if(isset($this->viewVars['menu_add'])) $form['add_menu']=$this->viewVars['menu_add'];
				$formOBJ->create();
				$formOBJ->save($form);
				$this->viewVars['form_id']=$formOBJ->GetInsertId();
			} else {
				//form found
				$this->viewVars['form_id']=$form['Form']['id'];
			}//endif
			//authenticate
			$this->viewVars['ACLtoken']=$this->ComputareUser->getToken($this->viewVars['form_id'],$this->Auth->user('id'));
			if(!$this->viewVars['ACLtoken']['view']) {
				//user does not have view permissions on this form
				$this->Session->setFlash(__('You do not have permissions to view this form.'));
				$this->redirect($this->referer());
			}//endif
			if ($this->request->is('post') || $this->request->is('put')) {
				//check for user post permissions
				if(!$this->viewVars['ACLtoken']['submit'])  {
					//ACL check failed
					$this->Session->setFlash(__('You do not have permissions to submit this form.'));
					$this->redirect($this->referer());
				}//endif
			}//endif
			//save user click
			$clickObj=ClassRegistry::init('FormsUser');
			$click=$clickObj->find('first',array('conditions'=>array('user_id'=>$this->Auth->user('id'),'form_id'=>$this->viewVars['form_id'])));
			//add forms association to get form name
			$clickObj->bindModel(array('belongsTo'=>array('Form'=>array('className'=>'Form','fields'=>array('name')))));
			$lastclick=$clickObj->find('first',array('order'=>array('FormsUser.modified'=>'desc'),'conditions'=>array('user_id'=>$this->Auth->user('id'),'form_id !='=>$this->viewVars['form_id'])));
			if($click) {
				//found previous visit(s)
				$click['FormsUser']['visits']+=1;
			} else {
				//first visit to this form
				$click['FormsUser']['user_id']=$this->Auth->user('id');
				$click['FormsUser']['form_id']=$this->viewVars['form_id'];
				$click['FormsUser']['visits']=1;
				$clickObj->create();
			}//endif
			$click['FormsUser']['last_url']=$this->request->url;
			$click['FormsUser']['last_click_id']=$lastclick['FormsUser']['id'];
// debug($lastclick);exit;
			$clickObj->save($click);
			//store previous URL for use in links
			$this->viewVars['previousURL']=$lastclick['FormsUser']['last_url'];
			$this->viewVars['previousFormName']=$lastclick['Form']['name'];
			unset($clickObj);
			unset($click);
			unset($lastclick);
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
		//setup array of conditions for pagination and text to show on report
		$this->conditions=array();
		$this->details=array();
		foreach($this->filterData as $filter) {
			//loop for each requested filter
			if($filter['type']==1) {
				//listbox filter
				if(isset($this->passedArgs[$filter['passName']]) && !empty($this->passedArgs[$filter['passName']])) {
					//has been passed
					$this->conditions[]=array($filter['field']=>$this->passedArgs[$filter['passName']]);
					//generate report text
					$t=$filter['label'].' showing only values: ';
					$comma=false;
					foreach($this->passedArgs[$filter['passName']] as $v) {
						//loop forall values
						if($comma) {
							//not the first in list
							$t.=', ';
						}//endif
						$comma=true;
						$t.=$filter['options'][$v];
					}//end foreach
					$this->details[]=$t;
					unset($t);
				}//endif
			}//endif
			if($filter['type']==2) {
				//range
				$t=null;
				if(isset($this->passedArgs[$filter['passName']]['min']) && !empty($this->passedArgs[$filter['passName']]['min'])) {
					//min is set
					$this->conditions[]=array($filter['field'].' >='=>$this->passedArgs[$filter['passName']]['min']);
					$t=' greater than or equal to '.$this->passedArgs[$filter['passName']]['min'];
				}//endif
				if(isset($this->passedArgs[$filter['passName']]['max']) && !empty($this->passedArgs[$filter['passName']]['max'])) {
					//max is set
					$this->conditions[]=array($filter['field'].' <='=>$this->passedArgs[$filter['passName']]['max']);
					if($t)$t.=' and';
					$t.=' less than or equal to '.$this->passedArgs[$filter['passName']]['max'];
				}//endif
				//generate report text
				if($t)$this->details[]=$filter['label'].' showing only values'.$t;
			}//endif
			if($filter['type']==3) {
				//Date
				$use=false;
				$t=$filter['label'].' showing only dates ';
				if(isset($this->passedArgs[$filter['passName']]['start']) && !empty($this->passedArgs[$filter['passName']]['start'])) {
					//min is set
					$this->conditions[]=array($filter['field'].' >='=>$this->passedArgs[$filter['passName']]['start']);
					$use=true;
					$t.='after '.$this->passedArgs[$filter['passName']]['start'];
				}//endif
				if(isset($this->passedArgs[$filter['passName']]['end']) && !empty($this->passedArgs[$filter['passName']]['end'])) {
					//max is set
					$this->conditions[]=array($filter['field'].' <='=>$this->passedArgs[$filter['passName']]['end']);
					if($use) $t.=' and ';
					$use=true;
					$t.='before '.$this->passedArgs[$filter['passName']]['end'];
				}//endif
				if($use) {
					//set report details text
					$this->details[]=$t;
				}//endif
				unset($t);
			}//endif type==3
			if($filter['type']==4) {
				//TF checkbox
				if(isset($this->passedArgs[$filter['passName']]) && $this->passedArgs[$filter['passName']]) {
					//true
					$this->conditions[]=$filter['trueCondition'];
					//set report details
					if(isset($filter['trueMessage'])) $this->details[]=$filter['trueMessage'];
					else $this->details[]='Only records where '.$filter['label'].' is true';
				} else {
					//false
					$this->conditions[]=$filter['falseCondition'];
					if(isset($filter['falseMessage'])) $this->details[]=$filter['falseMessage'];
					else $this->details[]='Only records where '.$filter['label'].' is false';
					//set report details
				}//endif
//debug($filter);exit;
			}//end type==4 TF
		}//endforeach
		//send report details to view
		$this->set('filterDetails',$this->details);
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
		//validate
		foreach($filterData as $i=>$fd){
			//loop for each filter passed in
			if(!isset($fd['passName']) && isset($fd['field'])) $filterData[$i]['passName']=$fd['field'];
		}//endforeach
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
	 * 	field=>field for comparison (EX:Glentry.created)
	 * 
	 * type==4: T/F checkbox (checkbox with conditions for t or f):
	 * 	trueCondition=>sql logic when box is checked (1 condition can be empty)
	 * 	falseCondition=>sql logic when box is not checked (1 condition can be empty)
	 * 	trueMessage=>text shown to user at top of report (can be empty or null, null will default)
	 * 	falseMessage=>text shown to user at top of report (can be empty or null, null will default)
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
	
	/**
	 * _addActionsLink
	 * 
	 * Used to add a link to the actions element
	 * will check if current user has this permission and only show if permission is valid
	 * ALSO if the form has not been visited it will show once until the link is clicked and form is added to table
	 * pass $actions array to element
	 * 
	 * @param $label label for link
	 * @param $action array with 'action','controller', etc  (controller is optional)
	 */
	protected function _addActionsLink($label, $action) {
		//add a link to actions menu
		$formOBJ=ClassRegistry::init('Form');
		$ret=false;
		if(isset($action['action'])) {
			//action must be set
			if(!isset($action['controller'])) $action['controller']=$this->params['controller'];
			//look for controller/action combo in forms table
			$form=$formOBJ->find('first',array(
				'conditions'=>array('controller'=>$action['controller'],'action'=>$action['action']),
				'fields'=>array('Form.id'),
				'recursive'=>0
				));
			if($form) {
				//form has been visited before, check permissions
				if($this->ComputareUser->authenticate($form['Form']['id'],$this->Auth->user('id'),'view')) {
					//user has permission
					$ret=true;
				}//endif
			} else {
				//form is not in table, show link
				$ret=true;
			}//endif
			if($ret ){
				//add link to form
				$this->actionsArray[]=array($label, $action);
				$this->set('actions',$this->actionsArray);
			}//endif
//debug($form);exit;
		}//endif action is set
	}//end protected function _addActionsLink
}
