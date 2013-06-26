<?php
App::uses('AppController', 'Controller');
/**
 * Glaccounts Controller
 *
 * @property Glaccount $Glaccount
 */
class GlaccountsController extends AppController {

	public $components=array('ComputareGL');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List GL Accounts');
		$this->set('add_menu',true);
		//use filters
		$filters=array();
		$filters[]=array(
			'type'=>1,
			'label'=>'Group',
			'passName'=>'grp',
			'field'=>'Glaccount.glgroup_id',
			'options'=>ClassRegistry::init('Glgroup')->find('list')
		);
		$this->_useFilter($filters);
		$this->Glaccount->recursive = 0;
		$this->Glaccount->order=array('group','name');
		$this->set('glaccounts', $this->paginate('Glaccount',$this->conditions));
		//find lists
//		$glgroups = $this->Glaccount->GlaccountDetail->Glgroup->find('list');
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('users'));
	}

/**
 * posting method
 */
	public function posting() {
		$this->set('formName','GL Posting');
		$this->set('add_menu',true);
		if(!isset($this->request->params['named']['credit']))$this->request->params['named']['credit']=array();
		if(!isset($this->request->params['named']['debit']))$this->request->params['named']['debit']=array();
		//check for incomming clicks
		if(isset($this->request->params['named']['adddebit'])) {
			//add a new debit account
			$this->request->params['named']['debit'][]=$this->request->params['named']['adddebit'];
			//unset adddebit to avoid redirect loop
			unset($this->request->params['named']['adddebit']);
			//redirect back to page
			$this->redirect($this->request->params['named']);
		}//endif adding debit
		if(isset($this->request->params['named']['addcredit'])) {
			//add a new credit account
			$this->request->params['named']['credit'][]=$this->request->params['named']['addcredit'];
			//unset addcredit to avoid redirect loop
			unset($this->request->params['named']['addcredit']);
			//redirect back to page
			$this->redirect($this->request->params['named']);
		}//endif adding credit
		if(isset($this->request->params['named']['remdebit'])) {
			//remove debit account
			unset($this->request->params['named']['debit'][$this->request->params['named']['remdebit']]);
			//unset remdebit to avoid redirect loop
			unset($this->request->params['named']['remdebit']);
			//redirect back to page
			$this->redirect($this->request->params['named']);
		}//endif removing debit
		if(isset($this->request->params['named']['remcredit'])) {
			//remove credit account
			unset($this->request->params['named']['credit'][$this->request->params['named']['remcredit']]);
			//unset remcredit to avoid redirect loop
			unset($this->request->params['named']['remcredit']);
			//redirect back to page
			$this->redirect($this->request->params['named']);
		}//endif removing credit
		if ($this->request->is('post') || $this->request->is('put')) {
			//post
			$this->request->data['Glentry']['created_id']=$this->Auth->user('id');
			if($this->ComputareGL->post($this->request->data)) {
				//saved ok
				$this->Session->setFlash(__('The GL post has been completed.'),'default',array('class'=>'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				//save failure
				$this->Session->setFlash(__('The GL post could not be completed. Please, try again.'));
			}//endif for save ok
//debug($this->request->data);exit;
		}//endif for posting
//debug($this->request->params['named']);exit;
		$this->Glaccount->recursive = 0;
		//setup list of accounts to exclude
		$exclude=array_merge($this->request->params['named']['credit'],$this->request->params['named']['debit']);
		$this->set('glaccounts', $this->paginate(array('NOT'=>array('Glaccount.id'=>$exclude))));
		//find lists
		$glaccountlist= $this->Glaccount->find('list');
		$this->set(compact('glaccountlist'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View GL Account');
		$this->Glaccount->id = $id;
		if (!$this->Glaccount->exists()) {
			throw new NotFoundException(__('Invalid glaccount'));
		}
		$this->Glaccount->recursive = 2;
		$this->set('glaccount', $this->Glaccount->read(null, $id));
		$users=ClassRegistry::init('User')->find('list');
		$this->set(compact('glgroups','users'));
		//get account balance
		$this->set('balance',$this->Glaccount->query('select sum(e.debit) as debit, sum(e.credit) as credit from glentries as e where e.glaccount_id='.$id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//adding account uses the edit function with null id
		$this->set('formName','Add New GL Account');
		$this->redirect(array('action' => 'edit'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit GL Account');
		if($id) {
			//validate $id
			$this->Glaccount->id = $id;
			if (!$this->Glaccount->exists()) throw new NotFoundException(__('Invalid account'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//save account data
			$this->request->data['GlaccountDetail']['created_id']=$this->Auth->user('id');
//debug($this->request->data);exit;
			if ($this->ComputareGL->saveAccount($this->request->data)) {
				$this->Session->setFlash(__('The GL account has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The GL account could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Glaccount->read(null, $id);
		}
		//get list of GL account groups
		$glgroups = $this->Glaccount->GlaccountDetail->Glgroup->find('list');
		if(count($glgroups)<1) {
			//must have at least one gl account group set up
			$this->Session->setFlash(__('You must first set up at least one GL account group before you can add accounts.'));
			$this->redirect(array('controller'=>'glgroups','action' => 'index'));
		}//endif
		$this->set(compact('glgroups'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Glaccount->id = $id;
		if (!$this->Glaccount->exists()) {
			throw new NotFoundException(__('Invalid glaccount'));
		}
		if ($this->Glaccount->delete()) {
			$this->Session->setFlash(__('Glaccount deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Glaccount was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
 */
}
