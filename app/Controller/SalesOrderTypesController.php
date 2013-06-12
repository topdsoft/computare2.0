<?php
App::uses('AppController', 'Controller');
/**
 * SalesOrderTypes Controller
 *
 * @property SalesOrderType $SalesOrderType
 */
class SalesOrderTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List SO Types');
		$this->SalesOrderType->recursive = 0;
		$this->set('salesOrderTypes', $this->paginate(array('SalesOrderType.active')));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add SO Type');
		if ($this->request->is('post')) {
			$this->SalesOrderType->create();
			$this->request->data['SalesOrderType']['active']=true;
			$this->request->data['SalesOrderType']['created_id']=$this->Auth->user('id');
			if ($this->SalesOrderType->save($this->request->data)) {
				$this->Session->setFlash(__('The sales order type has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales order type could not be saved. Please, try again.'));
			}
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
		$this->set('formName','Remove SO Type');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SalesOrderType->id = $id;
		if (!$this->SalesOrderType->exists()) {
			throw new NotFoundException(__('Invalid sales order type'));
		}
		$sotype=$this->SalesOrderType->read(null,$id);
		$sotype['SalesOrderType']['active']=false;
		$sotype['SalesOrderType']['removed']=date('Y-m-d H:i:s');
		$sotype['SalesOrderType']['active']=false;
		if ($this->SalesOrderType->delete()) {
			$this->Session->setFlash(__('Sales order type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sales order type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
