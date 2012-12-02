<?php
App::uses('AppController', 'Controller');
/**
 * Glentries Controller
 *
 * @property Glentry $Glentry
 */
class GlentriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','GL Entries List');
		//setup filters to use
		$filter=array();
		//group filter
		$options=ClassRegistry::init('Glgroup')->find('list');
		$filter[]=array('type'=>1,'passName'=>'gp','label'=>'Group','options'=>$options,'field'=>'Glaccount.glgroup_id');
//debug($options);exit;
		//account filter
		$options=$this->Glentry->Glaccount->find('list');
		$filter[]=array('type'=>1,'passName'=>'acc','label'=>'Account','options'=>$options,'field'=>'Glaccount.id');
		$this->_useFilter($filter);
		$this->Glentry->recursive = 0;
		$this->Glentry->order=array('Glentry.postDate'=>'desc','Glentry.id'=>'desc');
		$this->set('glentries', $this->paginate('Glentry',$this->conditions));
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('users'));
//$this->_filterRedirect();
	}

}
