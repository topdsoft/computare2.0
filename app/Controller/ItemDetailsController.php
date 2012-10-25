<?php
App::uses('AppController', 'Controller');
/**
 * ItemDetails Controller
 *
 * @property ItemDetail $ItemDetail
 */
class ItemDetailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemDetail->recursive = 0;
		$this->set('itemDetails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ItemDetail->id = $id;
		if (!$this->ItemDetail->exists()) {
			throw new NotFoundException(__('Invalid item detail'));
		}
		$this->set('itemDetail', $this->ItemDetail->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemDetail->create();
			//check for empty SKU
			$emptySKU=empty($this->request->data['ItemDetail']['sku']);
			if($emptySKU) $this->request->data['ItemDetail']['sku']='none';
			if ($this->ItemDetail->save($this->request->data)) {
				//detail saved ok, now create master item
				$itemDetail_id=$this->ItemDetail->getLastInsertId();
				$this->ItemDetail->Item->create();
				$this->ItemDetail->Item->save(array('itemDetail_id'=>$itemDetail_id,'active'=>true));
				$item_id=$this->ItemDetail->Item->getLastInsertId();
				//now set masteritem id in item detail
				$this->request->data['ItemDetail']['item_id']=$item_id;
				//if SKU was not entered set it to item_id
				if($emptySKU) $this->request->data['ItemDetail']['sku']=$item_id;
				$this->ItemDetail->save($this->request->data);
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				//clear empty SKU before returning
				if($emptySKU) $this->request->data['ItemDetail']['sku']=null;
				$this->Session->setFlash(__('The item could not be created. Please, try again.'));
			}
		}
		$items = $this->ItemDetail->Item->find('list');
		$categories = $this->ItemDetail->Category->find('list');
		$this->set(compact('items', 'categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$item=$this->ItemDetail->Item->read(null,$id);
//debug($item);exit;
		$this->ItemDetail->id = $item['Item']['itemDetail_id'];
		if (!$this->ItemDetail->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//create new itemDetail
			$this->ItemDetail->create();
			$this->request->data['ItemDetail']['id']=null;
			if ($this->ItemDetail->save($this->request->data)) {
				//save item master data
				$item['Item']['itemDetail_id']=$this->ItemDetail->getLastInsertId();
				$this->ItemDetail->Item->save($item);
				$this->Session->setFlash(__('The item has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'),'default',array('class'=>'message'));
			}
		} else {
			$this->request->data = $this->ItemDetail->read(null, $item['Item']['itemDetail_id']);
		}
		$items = $this->ItemDetail->Item->find('list');
		$categories = $this->ItemDetail->Category->find('list');
		$this->set(compact('items', 'categories'));
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
		$this->ItemDetail->id = $id;
		if (!$this->ItemDetail->exists()) {
			throw new NotFoundException(__('Invalid item detail'));
		}
		if ($this->ItemDetail->delete()) {
			$this->Session->setFlash(__('Item detail deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
