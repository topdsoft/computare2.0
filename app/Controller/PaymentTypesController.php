<?php
App::uses('AppController', 'Controller');
/**
 * PaymentTypes Controller
 *
 * @property PaymentType $PaymentType
 */
class PaymentTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Payment Types');
		$this->set('add_menu',true);
		$this->PaymentType->recursive = 0;
		$this->set('paymentTypes', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Paymnet Type');
		if ($this->request->is('post')) {
			//process submit
			$this->request->data['PaymentType']['created_id']=$this->Auth->user('id');
			$this->request->data['PaymentType']['active']=true;
			$this->PaymentType->create();
			if ($this->PaymentType->save($this->request->data)) {
				//saved ok
				$this->Session->setFlash(__('The payment type has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment type could not be saved. Please, try again.'));
			}
		}
		$glExpenseAccounts = array(null=>'')+$this->PaymentType->Glaccount->find('list');
		$this->set(compact('glExpenseAccounts'));
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
		$this->set('formName','Remove Payment Type');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PaymentType->id = $id;
		if (!$this->PaymentType->exists()) {
			throw new NotFoundException(__('Invalid payment type'));
		}
		$type=$this->PaymentType->read();
		$type['PaymentType']['removed']=date('Y-m-d H-i-s');
		$type['PaymentType']['removed_id']=$this->Auth->user('id');
		$type['PaymentType']['active']=false;
		if ($this->PaymentType->save($type)) {
			$this->Session->setFlash(__('Payment type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Payment type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
