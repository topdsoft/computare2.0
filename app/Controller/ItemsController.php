<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {

	public $components=array('ComputareIC');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Items');
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','Item Details');
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->redirect('edit');
		
		if ($this->request->is('post')) {
			$this->Item->create();
			$this->request->data['Item']['active']=true;
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been created'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$this->Item->getInsertId()));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Item->Customer->find('list');
		$groups = $this->Item->ItemGroup->find('list');
		$images = $this->Item->Image->find('list');
		$locations = $this->Item->Location->find('list');
		$vendors = $this->Item->Vendor->find('list');
		$this->set(compact('customers', 'groups', 'images', 'locations', 'vendors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if($id) {
			//editing item
			$this->set('formName','Edit Item'); 
			$this->Item->id = $id;
			if (!$this->Item->exists()) {
				throw new NotFoundException(__('Invalid item'));
			}
		} else $this->set('formName','New Item');
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareIC->saveItem($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
		}
		$customers = $this->Item->Customer->find('list');
		$groups = $this->Item->ItemGroup->find('list');
		$images = $this->Item->Image->find('list');
		$locations = $this->Item->Location->find('list');
		$vendors = $this->Item->Vendor->find('list');
		$this->set(compact('customers', 'groups', 'images', 'locations', 'vendors'));
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
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
