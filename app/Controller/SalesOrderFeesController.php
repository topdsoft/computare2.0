<?php
App::uses('AppController', 'Controller');
/**
 * SalesOrderFees Controller
 *
 * @property SalesOrderFee $SalesOrderFee
 */
class SalesOrderFeesController extends AppController {

/**
 * index method
 *
 * @return void
	public function index() {
		$this->SalesOrderFee->recursive = 0;
		$this->set('salesOrderFees', $this->paginate());
	}
 */

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function view($id = null) {
		$this->SalesOrderFee->id = $id;
		if (!$this->SalesOrderFee->exists()) {
			throw new NotFoundException(__('Invalid sales order fee'));
		}
		$this->set('salesOrderFee', $this->SalesOrderFee->read(null, $id));
	}
 */

/**
 * add method
 *
 * @return void
 * @param string $id  id of salesOrderType
 */
	public function add($id = null) {
		$this->set('formName','Add Sales Order Fee');
		//validate salesOrderType
		$soType=$this->SalesOrderFee->SalesOrderType->read(null, $id);
		if(!$soType) throw new NotFoundException(__('Invalid sales order type'));
		if(!$soType['SalesOrderType']['active']) throw new NotFoundException(__('Invalid sales order type'));
		
		if ($this->request->is('post')) {
			//save fee
			$this->request->data['SalesOrderFee']['created_id']=$this->Auth->user('id');
			$this->request->data['SalesOrderFee']['salesOrderType_id']=$id;
// debug($this->request->data);exit;
			$this->SalesOrderFee->create();
			if ($this->SalesOrderFee->save($this->request->data)) {
				$this->Session->setFlash(__('The sales order fee has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('controller'=>'salesOrderTypes','action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The sales order fee could not be saved. Please, try again.'));
			}
		}
		//$salesOrderTypes = $this->SalesOrderFee->SalesOrderType->find('list');
		$this->set('soTypeName',$soType['SalesOrderType']['name']);
		$this->set('glaccounts',array(null=>'(none)')+$this->SalesOrderFee->SalesOrderType->Glaccount->find('list'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function edit($id = null) {
		$this->SalesOrderFee->id = $id;
		if (!$this->SalesOrderFee->exists()) {
			throw new NotFoundException(__('Invalid sales order fee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SalesOrderFee->save($this->request->data)) {
				$this->Session->setFlash(__('The sales order fee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sales order fee could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SalesOrderFee->read(null, $id);
		}
		$salesOrderTypes = $this->SalesOrderFee->SalesOrderType->find('list');
		$this->set(compact('salesOrderTypes'));
	}
 */

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SalesOrderFee->id = $id;
		if (!$this->SalesOrderFee->exists()) {
			throw new NotFoundException(__('Invalid sales order fee'));
		}
		if ($this->SalesOrderFee->delete()) {
			$this->Session->setFlash(__('Sales order fee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sales order fee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
 */
}
