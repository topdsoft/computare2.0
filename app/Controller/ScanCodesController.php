<?php
App::uses('AppController', 'Controller');
/**
 * ScanCodes Controller
 *
 * @property ScanCode $ScanCode
 */
class ScanCodesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Scan Codes');
		$this->set('add_menu',true);
		$this->ScanCode->recursive = 0;
		$this->set('scanCodes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ScanCode->id = $id;
		if (!$this->ScanCode->exists()) {
			throw new NotFoundException(__('Invalid scan code'));
		}
		$this->set('scanCode', $this->ScanCode->read(null, $id));
	}

/**
 * add method
 *
 * @param type items,locations,itemSerialNumbers,users
 * @param id valid id for one of above
 * @return void
 */
	public function add($type=null, $id=null) {
		$this->set('formName','Add Scan Code');
		//validate
		if(!in_array($type,array('items','locations','itemSerialNumbers','users')) ) throw new NotFoundException(__('Invalid type'));
		if($type=='items') {
			//validate item
			$name=$this->ScanCode->Item->field('name',array('id'=>$id));
			if(!$name) throw new NotFoundException(__('Invalid item'));
		} elseif($type=='locations') {
			//validate location
			$name=$this->ScanCode->Location->field('name',array('id'=>$id));
			if(!$name) throw new NotFoundException(__('Invalid location'));
		} elseif($type=='users') {
			//validate user
			$name=$this->ScanCode->User->field('username',array('id'=>$id));
			if(!$name) throw new NotFoundException(__('Invalid user'));
		} elseif($type=='itemSerialNumbers') {
			//validate serial number
			$sn=$this->ScanCode->ItemSerialNumber->find('first',array('conditions'=>array('ItemSerialNumber.id'=>$id),'fields'=>array('Item.name','ItemSerialNumber.number')));
			if(!$sn) throw new NotFoundException(__('Invalid serial number'));
			$name=$sn['Item']['name'].' SN:'.$sn['ItemSerialNumber']['number'];
			unset($sn);
		}//endif
		if ($this->request->is('post')) {
			$this->ScanCode->create();
			if ($this->ScanCode->save($this->request->data)) {
				$this->Session->setFlash(__('The scan code has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scan code could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('name'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ScanCode->id = $id;
		if (!$this->ScanCode->exists()) {
			throw new NotFoundException(__('Invalid scan code'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ScanCode->save($this->request->data)) {
				$this->Session->setFlash(__('The scan code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scan code could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ScanCode->read(null, $id);
		}
		$items = $this->ScanCode->Item->find('list');
		$locations = $this->ScanCode->Location->find('list');
		$itemSerialNumbers = $this->ScanCode->ItemSerialNumber->find('list');
		$users = $this->ScanCode->User->find('list');
		$this->set(compact('items', 'locations', 'itemSerialNumbers', 'users'));
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
		$this->ScanCode->id = $id;
		if (!$this->ScanCode->exists()) {
			throw new NotFoundException(__('Invalid scan code'));
		}
		if ($this->ScanCode->delete()) {
			$this->Session->setFlash(__('Scan code deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Scan code was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
