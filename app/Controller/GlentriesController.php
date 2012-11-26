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
		$this->Glentry->recursive = 0;
		$this->Glentry->order=array('Glentry.postDate'=>'desc','Glentry.id'=>'desc');
		$this->Glentry->filter=array('here!');
		$this->set('glentries', $this->paginate());
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('users'));
//$this->_filterRedirect();
	}

}
