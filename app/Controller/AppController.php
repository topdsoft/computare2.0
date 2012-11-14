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
		//no ACL on login
		if($this->params['action']!='login') {
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
}
