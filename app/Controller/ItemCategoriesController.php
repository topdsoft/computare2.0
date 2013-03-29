<?php
App::uses('AppController', 'Controller');
/**
 * ItemCategories Controller
 *
 * @property ItemCategory $ItemCategory
 */
class ItemCategoriesController extends AppController {

	public $components=array('ComputareIC');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Item Categories');
		$this->ItemCategory->recursive = 0;
		$this->set('itemCategories', $this->paginate());
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
		$this->set('formName','View Item Category');
		$this->ItemCategory->id = $id;
		if (!$this->ItemCategory->exists()) {
			throw new NotFoundException(__('Invalid item category'));
		}
		$this->set('itemCategory', $this->ItemCategory->read(null, $id));
		$this->set('users', ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($parent_id=0) {
		$this->set('formName','New Item Category');
		if ($this->request->is('post')) {
			$this->ItemCategory->create();
			if ($this->ComputareIC->saveItemCategory($this->request->data)) {
				$this->Session->setFlash(__('The item category has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item category could not be saved. Please, try again.'));
			}
		} else $this->request->data['ItemCategory']['parent_id']=$parent_id;
		$parents = $this->ItemCategory->ParentItemCategory->find('list');
		$parents[0]='(none)';
		$this->set(compact('parents'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Item Category');
		$this->ItemCategory->id = $id;
		if (!$this->ItemCategory->exists()) {
			throw new NotFoundException(__('Invalid item category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareIC->saveItemCategory($this->request->data)) {
				$this->Session->setFlash(__('The item category has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemCategory->read(null, $id);
		}
		$parents = $this->ItemCategory->ParentItemCategory->find('list');
		$parents[0]='(none)';
		$this->set(compact('parents'));
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
		$this->ItemCategory->id = $id;
		if (!$this->ItemCategory->exists()) {
			throw new NotFoundException(__('Invalid item category'));
		}
		if ($this->ItemCategory->delete()) {
			$this->Session->setFlash(__('Item category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
