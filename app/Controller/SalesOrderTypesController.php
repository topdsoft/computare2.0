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
		$this->set('helplink','/pages/salesOrderTypes#l');
		$this->set('add_menu',true);
		$this->SalesOrderType->recursive = 0;
		$this->set('salesOrderTypes', $this->paginate(array('SalesOrderType.active')));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}


/**
 * view method
 *
 * @return void
 */
	public function view($id=null) {
		$this->set('formName','View Sales Order Type');
//		$this->set('helplink','/pages/salesOrderTypes#e');
		//validate
		$this->SalesOrderType->id = $id;
		if (!$this->SalesOrderType->exists()) {
			throw new NotFoundException(__('Invalid sales order type'));
		}//endif
		$this->set('salesOrderType',$this->SalesOrderType->read());
		$this->set('glaccounts',array(null=>'(none)')+$this->SalesOrderType->Glaccount->find('list'));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add SO Type');
		$this->set('helplink','/pages/salesOrderTypes#a');
		if ($this->request->is('post')) {
			//save
			$this->SalesOrderType->create();
			$this->request->data['SalesOrderType']['active']=true;
			$this->request->data['SalesOrderType']['created_id']=$this->Auth->user('id');
			//due days is only set for an account types
			if(!$this->request->data['SalesOrderType']['on_account']) unset($this->request->data['SalesOrderType']['due_days']);
			if ($this->SalesOrderType->save($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The sales order type has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//validatio faled
				$this->Session->setFlash(__('The sales order type could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data['SalesOrderType']=$this->passedArgs;
		}//endif
		//get lists
		$locations=array(null=>'(none)')+$this->SalesOrderType->Location->generateTreeList(null,null,null,' - ');
		$glaccounts=array(null=>'(none)')+$this->SalesOrderType->Glaccount->find('list');
		$this->set(compact('locations','glaccounts'));
	}

/**
 * edit method
 * @param $id
 */
	public function edit($id=null) {
		$this->set('formName','Edit Sales Order Type');
		$this->set('helplink','/pages/salesOrderTypes#e');
		//validate
		$this->SalesOrderType->id = $id;
		if (!$this->SalesOrderType->exists()) {
			throw new NotFoundException(__('Invalid sales order type'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			if ($this->SalesOrderType->save($this->request->data)) {
				$this->Session->setFlash(__('The Sales Order Type has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Sales Order Type could not be saved. Please, try again.'));
			}
		} else {
			//get data
			$this->request->data = $this->SalesOrderType->read(null, $id);
		}//endif
		//get locations
		$this->set('locations',array(null=>'(none)')+$this->SalesOrderType->Location->generateTreeList(null,null,null,' - '));
		$this->set('glaccounts',array(null=>'(none)')+$this->SalesOrderType->Glaccount->find('list'));
		$this->set('users',ClassRegistry::init('User')->find('list'));
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
