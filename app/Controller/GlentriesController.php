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
		//debit-credit filters
		$filter[]=array('type'=>2,'passName'=>'dbt','label'=>'Debit','field'=>'Glentry.debit');
		$filter[]=array('type'=>2,'passName'=>'crt','label'=>'Credit','field'=>'Glentry.credit');
		$this->_useFilter($filter);
		$this->Glentry->recursive = 0;
		$this->Glentry->order=array('Glentry.postDate'=>'desc','Glentry.id'=>'desc');
		$this->set('glentries', $this->paginate('Glentry',$this->conditions));
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('users'));
		//get totals
		$debitTotal=$this->Glentry->field('sum(debit)',array($this->conditions));
		$creditTotal=$this->Glentry->field('sum(credit)',array($this->conditions));
		$this->set(compact('debitTotal','creditTotal'));
//$this->_filterRedirect();
	}

}
