<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseOrders Controller
 *
 * @property PurchaseOrder $PurchaseOrder
 */
class PurchaseOrdersController extends AppController {

	public $components=array('ComputareAP');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Purchase orders');
		$this->PurchaseOrder->recursive = 0;
		$this->set('purchaseOrders', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','View Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		$this->PurchaseOrder->bindModel(
			array('hasMany' => array(
				'RemovedLine' => array(
					'className'=>'PurchaseOrderDetail',
					'conditions'=>array('RemovedLine.active'=>false)
					),
				)
			)
		);
		$this->set('purchaseOrder', $this->PurchaseOrder->read(null, $id));
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/**
 * add method
 *
 * @return void
 * @param $vendor_id (optional)
 */
	public function add($vendor_id=null) {
		$this->set('formName','New Purchase Order');
		if ($this->request->is('post')) {
			$this->request->data['PurchaseOrder']['status']='O';
// debug($this->request->data);exit;
			if ($this->ComputareAP->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$this->PurchaseOrder->getInsertId()));
			} else {
				$this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'));
			}
		} else {
			//default
			$this->request->data['PurchaseOrder']['vendor_id']=$vendor_id;
		}//endif
		$vendors = $this->PurchaseOrder->Vendor->find('list');
		$this->set(compact('vendors'));
	}

/**
 * addline method
 *
 * @param int $id  (po id)
 * @return void
 */
	public function addline($id=null) {
		$this->set('formName','Edit Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
// debug($this->request->data);exit;
			if ($this->ComputareAP->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'));
			}
		} //endif
		$this->request->data = $this->PurchaseOrder->read(null, $id);
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/** removeline method
 * @param int $id (purchseOederDetails.id for line to remove)
 */
	public function removeline($id) {
		$this->set('formName','Edit Purchase Order');
		$podetail=$this->PurchaseOrder->PurchaseOrderDetail->read(null, $id);
		if (!$podetail) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if($this->ComputareAP->savePO(array('removeLine'=>$id))) $this->Session->setFlash(__('The line has been removed'),'default',array('class'=>'success'));
		else $this->Session->setFlash(__('The line could not be removed'));
		$this->redirect(array('action' => 'edit',$podetail['PurchaseOrderDetail']['purchaseOrder_id']));
	}

/** void method
 * @param int $id
 */
	public function void($id) {
		$this->set('formName','Void Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		$data['PurchaseOrder']['id']=$id;
		$data['PurchaseOrder']['status']='V';
		if($this->ComputareAP->savePO($data)) $this->Session->setFlash(__('The PO has been voided'),'default',array('class'=>'success'));
		else $this->Session->setFlash(__('The PO could not be voided'));
		$this->redirect(array('action' => 'index'));
	}

/** close method
 * @param int $id
 */
	public function close($id) {
		$this->set('formName','Close Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		$this->request->data['PurchaseOrder']['id']=$id;
		$this->request->data['PurchaseOrder']['status']='C';
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ComputareAP->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been closed'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order could not be closed. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PurchaseOrder->read(null, $id);
		}
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
// 		if($this->ComputareAR->savePO($data)) $this->Session->setFlash(__('The PO has been closed'),'default',array('class'=>'success'));
// 		else $this->Session->setFlash(__('The PO could not be closed'));
// 		$this->redirect(array('action' => 'index'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if($this->PurchaseOrder->field('status')!='O') {
			//must be status => O
			$this->Session->setFlash(__('The purchase order must be status of Open to edit.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
// 			$this->redirect(array('action' => 'index'));
			$this->request->data['PurchaseOrder']['status']='O';
// debug($this->request->data);exit;
			if ($this->ComputareAP->savePO($this->request->data)) {
				$this->Session->setFlash(__('The purchase order has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PurchaseOrder->read(null, $id);
		}
		$this->set('users',ClassRegistry::init('User')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
	}

/**
 * receive method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function receive($id = null) {
		$this->set('formName','Receive Purchase Order');
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if($this->PurchaseOrder->field('status')!='O') {
			//must be status => O
			$this->Session->setFlash(__('The purchase order must be status of Open to receive.'));
			$this->redirect(array('action' => 'index'));
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//returning data from form
			if($this->request->data['PurchaseOrder']['pass']==2) {
				//validate serial numbers
				
				if ($this->ComputareAP->receivePO($this->request->data)) {
					$this->Session->setFlash(__('The purchase order has been received'),'default',array('class'=>'success'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The purchase order could not be received. Please, try again.'));
				}
			}//endif
			//check for serialized items
			$serialized=false;
			foreach($this->request->data['PurchaseOrderDetail'] as $i=>$detail) {
				//loop for all lines
				if($detail['recQty'] && !$serialized) {
					//only check if qty was entered and serialized item not allready found
					$item_id=$this->PurchaseOrder->PurchaseOrderDetail->field('item_id',array('PurchaseOrderDetail.id'=>$detail['id']));
					if($this->PurchaseOrder->PurchaseOrderDetail->Item->field('serialized',array('Item.id'=>$item_id))) {
						//this item is serialized
						$this->request->data['PurchaseOrderDetail'][$i]['serialized']=true;
						$serialized=true;
					}//endif
					unset($item_id);
				}//endif
			}//end foreach
// debug($this->request->data);exit;
			$this->request->data['PurchaseOrder']['status']='O';
			if($this->request->data['PurchaseOrder']['pass']==1 && !$serialized) {
				//not serialized, just save
				if ($this->ComputareAP->receivePO($this->request->data)) {
					$this->Session->setFlash(__('The purchase order has been received'),'default',array('class'=>'success'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The purchase order could not be received. Please, try again.'));
				}
			} else {
				//go to pass 2
				$userData=$this->request->data;
				$this->request->data = $this->PurchaseOrder->read(null, $id);
				$this->request->data['PurchaseOrder']['pass']=2;
				//preserve user entered Data
				$this->request->data['PurchaseOrder']['shipping']=$userData['PurchaseOrder']['shipping'];
				$this->request->data['PurchaseOrder']['tax']=$userData['PurchaseOrder']['tax'];
				foreach($userData['PurchaseOrderDetail'] as $i=>$d) {
					//loop for all user entered data and save to new array
					$this->request->data['PurchaseOrderDetail'][$i]['recQty']=$d['recQty'];
					if(isset($d['serialized'])) $this->request->data['PurchaseOrderDetail'][$i]['serialized']=true;
				}//end foreach
				unset($userData);
			}//endif 
		} else {
			$this->request->data = $this->PurchaseOrder->read(null, $id);
			$this->request->data['PurchaseOrder']['pass']=1;
		}
		$this->set('locations',ClassRegistry::init('Location')->find('list'));
		$this->set('receiptTypes',ClassRegistry::init('ReceiptType')->find('list'));
		$this->set('items',ClassRegistry::init('Item')->find('list'));
		$this->Session->setFlash(__('Changes made on this form are not saved until you click Submit'),'default',array('class'=>'notice'));
	}

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
		$this->PurchaseOrder->id = $id;
		if (!$this->PurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid purchase order'));
		}
		if ($this->PurchaseOrder->delete()) {
			$this->Session->setFlash(__('Purchase order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Purchase order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
 */
}
