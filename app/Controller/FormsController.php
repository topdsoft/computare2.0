<?php
App::uses('AppController', 'Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','View Forms');
		$this->set('add_menu',true);
		//use filters
		$filters=array();
		//group filter
		$filters[]=array(
			'type'=>1,
			'label'=>'Group',
			'passName'=>'grp',
			'field'=>'Form.formGroup_id',
			'options'=>$this->Form->FormGroup->find('list')
			);
		//controller filter
		$options=array();
		$q=$this->Form->query('select controller from '.$this->Form->table.' group by controller');
		foreach($q as $type) $options[$type['forms']['controller']]=$type['forms']['controller'];
		unset($q);
		$filters[]=array(
			'type'=>1,
			'label'=>'Controller',
			'passName'=>'cont',
			'field'=>'Form.controller',
			'options'=>$options
			);
		unset($options);
		//action filter
		$options=array();
		$q=$this->Form->query('select action from '.$this->Form->table.' group by action');
		foreach($q as $type) $options[$type['forms']['action']]=$type['forms']['action'];
		unset($q);
		$filters[]=array(
			'type'=>1,
			'label'=>'Action',
			'passName'=>'act',
			'field'=>'Form.action',
			'options'=>$options
			);
		unset($options);
		//created filter
		$filters[]=array('type'=>3,
			'label'=>'Date',
			'passName'=>'created',
			'field'=>'Form.created');
		//Created by filter
		$filters[]=array(
			'type'=>1,
			'label'=>'User',
			'passName'=>'user',
			'field'=>'Form.created_id',
			'options'=>$this->Form->User->find('list')	);
		//empty helplink
		$filters[]=array('type'=>4,
			'label'=>'Form w/o Help',
			'trueCondition'=>'Form.helplink=""',
			'falseMessage'=>'',
			'falseCondition'=>'',
			'trueMessage'=>'Showing forms without help link defined',
			'passName'=>'showDeleted'
		);
		//submit filters
		$this->_useFilter($filters);
		$this->Form->recursive = 0;
		$this->set('forms', $this->paginate('Form',$this->conditions));
		//get users list
		$this->set('usersList',$this->Form->User->find('list'));
		//set redirect
		$this->set('redirect',array('controller'=>'forms','action'=>'index')+$this->request->params['named']);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function view($id = null) {
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		$this->set('form', $this->Form->read(null, $id));
	}
 */

/**
 * add method
 *
 * @return void
	public function add() {
		if ($this->request->is('post')) {
			$this->Form->create();
			//created_id is current user id
			$this->request->data['Form']['created_id']=$this->Auth->user('id');
//debug($this->request->data);exit;
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		}
		$groups = $this->Form->Group->find('list');
		$menus = $this->Form->Menu->find('list');
		$users = $this->Form->User->find('list');
		$this->set(compact('groups', 'menus', 'users'));
	}
 */

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Form');
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['Form']['formGroup_id']==0) unset($this->request->data['Form']['formGroup_id']);
// debug($this->request->data);exit;
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'),'default',array('class'=>'success'));
				if(isset($this->request->params['named']['redirect'])) $this->redirect($this->request->params['named']['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Form->read(null, $id);
			if(!$this->request->data['Form']['formGroup_id']) $this->request->data['Form']['formGroup_id']=0;
		}
		$formGroups = $this->Form->FormGroup->find('list');
		$formGroups[0]='(none)';
// 		$menus = $this->Form->Menu->find('list');
// 		$users = $this->Form->User->find('list');
		$this->set(compact('formGroups'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->set('formName','Delete Form');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
// debug($this);exit;
		if ($this->Form->delete()) {
			$this->Session->setFlash(__('Form deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Form was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
