<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate());
		$users = $this->Menu->User->find('list');
		array_unshift($users,'Public');
		$this->set(compact('users'));
	}

/**
 * indexbyuser method
 *
 * @return void
 */
	public function indexbyuser($user_id = null) {
		$this->Menu->User->id=$user_id;
		if(!$this->Menu->User->exists()) throw new NotFoundException(__('Invalid user'));
		//get users menu data
		$this->Menu->MenusUser->bindModel(array('belongsTo'=>array('Menu')));
		$menuList=$this->Menu->MenusUser->find('all',array('conditions'=>array('MenusUser.user_id'=>$user_id),'order'=>'ordr'));
		$this->set('menus',$menuList);
		//get user's name
		$this->set('username',$this->Menu->User->field('username',array('id'=>$user_id)));
//debug($menuList);exit;
//		$this->Menu->recursive = 0;
//		$this->set('menus', $this->paginate());
//		$users = $this->Menu->User->find('list');
//		array_unshift($users,'Public');
//		$this->set(compact('users'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','List Menus');
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->set('menuName', $this->Menu->field('name', array('id'=>$id)));
		//get forms for this menu
		$this->Menu->FormsMenu->bindModel(array('belongsTo'=>array('Form')));
		$forms=$this->Menu->FormsMenu->find('all',array('conditions'=>array('FormsMenu.menu_id'=>$id),'order'=>'ordr'));
		$this->set('forms',$forms);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Menu');
		if ($this->request->is('post')) {
			$this->Menu->create();
			$this->request->data['Menu']['created_id']=$this->Auth->user('id');
			if ($this->Menu->save($this->request->data)) {
				//new menu has been saved ok
				if($this->request->data['Menu']['user_id']!=0) {
					//add menu to specific user
					$menu_id=$this->Menu->getInsertId();
					//find end of users menus
					$user_id=$this->request->data['Menu']['user_id'];
					$this->Menu->addMenuToUser($menu_id,$user_id);
				}//endif
				$this->Session->setFlash(__('The menu has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		}
		$forms = $this->Menu->Form->find('list');
		$users = $this->Menu->User->find('list');
		array_unshift($users,'Public');
		$this->set(compact('forms', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Menu');
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
//debug($this->request->data);exit;
			if ($this->Menu->save($this->request->data)) {
				//before saving new links, delete the old
				$this->Menu->FormsMenu->deleteAll(array('FormsMenu.menu_id'=>$id),false);
				if(isset($this->request->data['Data'])){
					//loop for link data and save
					$i=0;
					foreach($this->request->data['Data'] as $link) {
						//loop for each row that comes in
						$i++;
						$this->Menu->FormsMenu->save(array(
							'id'=>null,
							'form_id'=>$link['form_id'],
							'menu_id'=>$id,
							'ordr'=>$i,
							'name'=>$link['label'],
							'params'=>$link['params']
						));
					}//end foreach
				}//endif
				$this->Session->setFlash(__('Your menu changes have been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$this->Menu->recursive=0;
			$this->request->data = $this->Menu->read(null, $id);
			//get list of links on this menu and save to data
			$this->request->data['Data']=array();
			$links=$this->Menu->FormsMenu->find('all',array('conditions'=>array('FormsMenu.menu_id'=>$id),'order'=>'ordr'));
			$i=0;
			foreach($links as $link) {
				//loop for all existing links and save into data
				$i++;
				$this->request->data['Data'][$i]=array(
					'label'=>$link['FormsMenu']['name'],
					'form_id'=>$link['FormsMenu']['form_id'],
					'params'=>$link['FormsMenu']['params']
				);
			}//end foreach
//debug($this->request->data);
		}
		//get list of ALL forms to use in dropdown list
		$formlist = $this->Menu->Form->find('list');
		//add 'none' value with index of 0 for selecting a heading not a link
		$formlist=array_reverse($formlist,true);
		$formlist[0]='(none)';
		$formlist=array_reverse($formlist,true);
//debug($formlist);exit;
		$this->set(compact('formlist'));
//		$this->set('menu',$this->Menu->read(null, $id));
	}

/**
 * editusers method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function editusers($id = null) {
		$this->set('formName','Edit Menu Users');
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if($this->Menu->field('user_id',array('id'=>$id))!=0) throw new NotFoundException(__('Invalid menu'));
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Menu->read(null, $id);
		}
		$forms = $this->Menu->Form->find('list');
		$users = $this->Menu->User->find('list');
		$this->set(compact('forms', 'users'));
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
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->Menu->delete()) {
			$this->Session->setFlash(__('Menu deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function moveup($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Menu->MenusUser->id = $id;
		if (!$this->Menu->MenusUser->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		//get user_id
		$user_id=$this->Menu->MenusUser->field('user_id',array('id'=>$id));
		//check that ordr is correct
		$this->Menu->cleanUpMenuOrder($user_id);
		//get current data
		$menu=$this->Menu->MenusUser->read(null,$id);
		//move menu up list by subtracting 1.5
		$menu['MenusUser']['ordr']-=1.5;
		$this->Menu->MenusUser->save($menu);
		//fix menu ordr
		$this->Menu->cleanUpMenuOrder($user_id);
		$this->redirect(array('action' => 'indexbyuser',$user_id));
	}
	
	public function movedown($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Menu->MenusUser->id = $id;
		if (!$this->Menu->MenusUser->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		//get user_id
		$user_id=$this->Menu->MenusUser->field('user_id',array('id'=>$id));
		//check that ordr is correct
		$this->Menu->cleanUpMenuOrder($user_id);
		//get current data
		$menu=$this->Menu->MenusUser->read(null,$id);
		//move menu down list by adding 1.5
		$menu['MenusUser']['ordr']+=1.5;
		$this->Menu->MenusUser->save($menu);
		//fix menu ordr
		$this->Menu->cleanUpMenuOrder($user_id);
		$this->redirect(array('action' => 'indexbyuser',$user_id));
	}
}
