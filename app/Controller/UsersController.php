<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $components=array('ComputareSysevent','ComputareUser');

	public function beforeFilter() {
		$this->Auth->allow('addFirstUser');
		parent::beforeFilter();
	}

/** addFirstUser method
 * 
 * @return void
 * 
 * used the first time system is started to set up user_id=1
 */
	public function addFirstUser() {
		$this->set('formName','Add First User');
		//validate first time use
		if($this->User->read(null,1)) $this->redirect(array('action'=>'index'));
		if ($this->request->is('post')) {
			//save first user
			$this->request->data['User']['active']=true;
			$this->User->create();
debug($this->request->data);
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'logout'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}//endif
		}//endif
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Users');
		$this->set('add_menu',true);
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View User');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * viewperm method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function viewperm($id = null) {
		$this->set('formName','View User Permissions');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if($id==1) $this->Session->setFlash(__('The Root User has permissions to all forms'),'default',array('class'=>'notice'));
// debug($this->ComputareUser->getToken(12,$id));exit;
		
		$this->User->unbindModel(array('hasAndBelongsToMany'=>array('Menu')));
		$this->User->Form->FormGroup->bindModel(array(
			'hasMany'=>array(
				'Form'=>array(
					'className'=>'Form',
				)
			)
		));
		$this->User->bindModel(array(
			'hasAndBelongsToMany'=>array(
				'Form'=>array(
					'className'=>'Form',
					'joinTable'=>'permissionSets',
					'foreignKey'=>'user_id',
					'associationForeignKey'=>'form_id'
				),
				'FormGroup'=>array(
					'className'=>'FormGroup',
					'joinTable'=>'permissionSets',
					'foreignKey'=>'user_id',
					'associationForeignKey'=>'formGroup_id'
				)
			)
		));
		$this->User->UserGroup->bindModel(array(
			'hasAndBelongsToMany'=>array(
				'Form'=>array(
					'className'=>'Form',
					'joinTable'=>'permissionSets',
					'foreignKey'=>'userGroup_id',
					'associationForeignKey'=>'form_id'
				),
				'FormGroup'=>array(
					'className'=>'FormGroup',
					'joinTable'=>'permissionSets',
					'foreignKey'=>'userGroup_id',
					'associationForeignKey'=>'formGroup_id'
				)//*/
			)
		));
		$this->User->recursive=3;
		$user=$this->User->read(null, $id);
		//loop for all forms found and get ACL token for form
		foreach($user['Form'] as $i=>$form) {
			//loop for all individually assigned forms
			$user['Form'][$i]['Token']=$this->ComputareUser->getToken($form['id'],$id);
		}//end foreach
		foreach($user['FormGroup'] as $i=>$group) {
			//loop for all formgroups assigned to this user
			foreach($group['Form'] as $j=>$form) {
				//loop for each form in this group
				$user['FormGroup'][$i]['Form'][$j]['Token']=$this->ComputareUser->getToken($form['id'],$id);
			}//endforeach
		}//endforeach
		foreach($user['UserGroup'] as $i=>$group) {
			//loop for all groups
			foreach($group['Form'] as $j=>$form) {
				//loop for each form in the group
				$user['UserGroup'][$i]['Form'][$j]['Token']=$this->ComputareUser->getToken($form['id'],$id);
			}//end foreach
		}//end foreach
		foreach($user['UserGroup'] as $i=>$userGroup) {
			//loop for all user groups
			foreach($userGroup['FormGroup'] as $j=>$formGroup) {
				//loop for each form group
				foreach($formGroup['Form'] as $k=>$form) {
					//loop for each form in the group
					$user['UserGroup'][$i]['FormGroup'][$j]['Form'][$k]['Token']=$this->ComputareUser->getToken($form['id'],$id);
				}//end foreach
			}//end foreach
		}//end foreach
		$this->set('user', $user);
		//get list of available permissions 
		$this->set('permissions', $this->ComputareUser->getPermissionList());
// debug($this->User->read(null, $id));exit;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add User');
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}//endif
		} else {
			//defaults
			$this->request->data['User']=$this->passedArgs;
		}//endif
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit User');
		$this->User->id = $id;
//$this->ComputareUser->setUserGroupToFormGroupPermission(2,2,array('view','submit','undoOthers'),1);
//$this->ComputareUser->authenticate(13,2,'view');exit;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareUser->saveUser($this->request->data,$this->Auth->User('id'))) {
				$this->Session->setFlash(__('The user has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$this->set('userGroups',$this->User->UserGroup->find('list'));
		//get permission sets
		$this->PermissionSet=ClassRegistry::init('PermissionSet');
		$this->set('perms',$this->PermissionSet->find('all',array('conditions'=>array('user_id'=>$id))));
		$this->set('permList',$this->ComputareUser->getPermissionList());
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
		$this->set('formName','Delete User');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * login controller
 */
	public function login() {
		$this->layout='login';
		if ($this->request->is('post')) {
			//save company in session data
			$company=$this->request->data['User']['company'];
			Configure::write('Company',$company);
			$this->Session->write('Company',$company);
//debug();debug($this->Session->read('company'));exit;
			//before handing off to the auth component, make sure db connection is good
			App::Import('Model','ConnectionManager');
			$config = ConnectionManager::getDataSource('default')->config;
//debug($config);
			$config['database'] = $company;
			$results=true;
			try {$results=ConnectionManager::create($company, $config);}
			catch (Exception $e) {$results=false;}
//debug($results);exit;
			if($results) {
				if ($this->Auth->login()) {
//debug($this->Auth->user());exit;
					//user login successfull so load menu structure into session
					$this->loadMenu();
					return $this->redirect($this->Auth->redirect());
				} else {
					//login failed check if first time use
					if(!$this->User->read(null,1)) $this->redirect(array('action'=>'addFirstUser'));
					$this->Session->setFlash(__('Your Credentials are incorrect'), 'default', array(), 'auth');
					//log failure
					$logdata=array('event_type'=>3,
						'title'=>__('Failed Cred'),
						'errorEvent'=>array('message'=>__('Login fail User:').$this->request->data['User']['username']));
					$this->ComputareSysevent->save($logdata);
				}
			} else {
				$this->Session->setFlash(__('Company is incorrect'), 'default', array(), 'auth');
				$this->User->useTable=false;
				//log failure
# LOG to server
			}
		} else {
			//user model can't use a database table until someone chooses the company and logs in 
			$this->User->useTable=false;
		}
	}
	
	public function logout() {
		//remove company session data
		$this->Session->delete('company');
		$this->redirect($this->Auth->logout());
	}

	protected function loadMenu() {
		//load user menu data into session
		$user_id=$this->Auth->user('id');
		$this->User->MenusUser->bindModel(array('belongsTo'=>array('Menu')));
 		$menus=$this->User->MenusUser->find('all',array('order'=>'MenusUser.ordr',
			'recursive'=>1,
			'conditions'=>array('MenusUser.user_id'=>$user_id)));
		//parse results and build an array to store in session data
		$menuArray=array();
		foreach($menus as $menu) {
			//loop for each menu
			$element=array('name'=>$menu['Menu']['name'],
				'id'=>$menu['Menu']['id'],
				'Form'=>array());
			//get menu links(forms) for this menu
			$this->User->Menu->FormsMenu->bindModel(array('belongsTo'=>array('Form')));
			$links=$this->User->Menu->FormsMenu->find('all',array('conditions'=>array('FormsMenu.menu_id'=>$menu['Menu']['id'])));
//debug($links);exit;
			foreach($links as $link) {
				//loop for each form (or link) in menu
				$element['Form'][]=array(
					'name'=>$link['FormsMenu']['name'],
					'controller'=>$link['Form']['controller'],
					'action'=>$link['Form']['action'],
					'params'=>$link['FormsMenu']['params']
					);
			}//ednforeach link
			$menuArray[]=$element;
		}//endforeach menu
		$this->Session->write('Menu',$menuArray);
		//also find and save company name for header
		$this->Session->write('CompanyName',ClassRegistry::init('Programsetting')->field('full_name'));
//debug($menuArray);exit;
	}
}
