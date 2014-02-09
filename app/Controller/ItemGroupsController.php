<?php
App::uses('AppController', 'Controller');
/**
 * ItemGroups Controller
 *
 * @property ItemGroup $ItemGroup
 */
class ItemGroupsController extends AppController {

	public $components=array('ComputareIC');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Item Groups');
		$this->ItemGroup->recursive = 0;
		$this->set('itemGroups', $this->paginate());
		$this->set('users', ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View User Group');
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			throw new NotFoundException(__('Invalid item group'));
		}
		$this->set('itemGroup', $this->ItemGroup->read(null, $id));
		$this->set('users', ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Item Group');
		if ($this->request->is('post')) {
			//save data
			$this->ItemGroup->create();
			if ($this->ComputareIC->saveItemGroup($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The item group has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//validation fail
				$this->Session->setFlash(__('The item group could not be saved. Please, try again.'));
			}//endif
		} else {
			//load defaults
			$this->request->data['ItemGroup']=$this->passedArgs;
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
		$this->set('formName','Edit Item Group');
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			throw new NotFoundException(__('Invalid item group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//save data
			if ($this->ComputareIC->saveItemGroup($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The item group has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//validation fail
				$this->Session->setFlash(__('The item group could not be saved. Please, try again.'));
			}//endif
		} else {
			//read record
			$this->request->data = $this->ItemGroup->read(null, $id);
		}//endif
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
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			throw new NotFoundException(__('Invalid item group'));
		}
		if ($this->ItemGroup->delete()) {
			$this->Session->setFlash(__('Item group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
