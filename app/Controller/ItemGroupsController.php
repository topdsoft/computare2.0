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
			$this->ItemGroup->create();
			if ($this->ComputareIC->saveItemGroup($this->request->data)) {
				$this->Session->setFlash(__('The item group has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item group could not be saved. Please, try again.'));
			}
		}
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
			if ($this->ComputareIC->saveItemGroup($this->request->data)) {
				$this->Session->setFlash(__('The item group has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemGroup->read(null, $id);
		}
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
