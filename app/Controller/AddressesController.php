<?php
App::uses('AppController', 'Controller');
/**
 * Addresses Controller
 *
 * @property Address $Address
 */
class AddressesController extends AppController {


/**
 * add method
 *
 * @param $controller currently customers or vendors
 * @param $id customer_id or vendor_id
 * @return void
 */
	public function add($controller, $id) {
		$this->set('formName','Add Address');
		if ($this->request->is('post')) {
			$this->request->data['Address']['created_id']=$this->Auth->user('id');
			$this->request->data['Address']['active']=true;
			if($controller=='customers')$this->request->data['Address']['customer_id']=$id;
			if($controller=='vendors')$this->request->data['Address']['vendor_id']=$id;
// debug($this->request->data);exit;
			$this->Address->create();
			if ($this->Address->save($this->request->data)) {
				$this->Session->setFlash(__('The address has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('controller'=>$controller,'action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.'));
			}
		}
		//get customer or vendor name
		if($controller=='customers') {
			//lookup customer name
			$cust=$this->Address->Customer->field('name',array('Customer.id'=>$id));
			if(!$cust) throw new NotFoundException(__('Invalid customer'));
			$this->set('name','Customer: '.$cust);
		} else {
			//lookup vendor name
			$vendor=$this->Address->Vendor->field('name',array('Vendor.id'=>$id));
			if(!$vendor) throw new NotFoundException(__('Invalid vendor'));
			$this->set('name','Vendor: '.$vendor);
		}//endif
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Address');
		$this->Address->id = $id;
		if (!$this->Address->exists()) {
			throw new NotFoundException(__('Invalid address'));
		}
		$address=$this->Address->read(null, $id);
		if($address['Customer']['name']) {
			//address id for a customer
			$this->set('name','Customer: '.$address['Customer']['name']);
			$controller='customers';
			$return_id=$address['Customer']['id'];
		}//endif
		if($address['Vendor']['name']) {
			$this->set('name','Vendor: '.$address['Vendor']['name']);
			$controller='vendors';
			$return_id=$address['Vendor']['id'];
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//start new address
			unset($this->request->data['Address']['id']);
			$this->request->data['Address']['created_id']=$this->Auth->user('id');
			$this->Address->create();
			if ($this->Address->save($this->request->data)) {
				//set old address to deleted
				$this->Address->save(array('Address'=>array('id'=>$id,'active'=>false)));
				$this->Session->setFlash(__('The address has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('controller'=>$controller,'action' => 'edit',$return_id));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.'));
			}//endif
			$this->request->data['Address']['id']=$id;
		} else {
			$this->request->data = $address;
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
		$this->set('formName','Edit Address');
		$this->Address->id = $id;
		if (!$this->Address->exists()) {
			throw new NotFoundException(__('Invalid address'));
		}
		$address=$this->Address->read(null, $id);
		if($address['Customer']['name']) {
			//address id for a customer
			$controller='customers';
			$return_id=$address['Customer']['id'];
		}//endif
		if($address['Vendor']['name']) {
			$controller='vendors';
			$return_id=$address['Vendor']['id'];
		}//endif
		
		if ($this->Address->save(array('active'=>false))) {
			$this->Session->setFlash(__('Address deleted'));
			$this->redirect(array('controller'=>$controller,'action' => 'edit',$return_id));
		}
		$this->Session->setFlash(__('Address was not deleted'));
		$this->redirect(array('controller'=>$controller,'action' => 'edit',$return_id));
	}
}
