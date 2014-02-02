<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Contacts $Contacts
 */
class ContactsController extends AppController {


/**
 * add method
 *
 * @param $controller currently customers or vendors
 * @param $id customer_id or vendor_id
 * @return void
 */
	public function add($controller, $id) {
		$this->set('formName','Add Contact');
		if ($this->request->is('post')) {
			$this->request->data['Contacts']['created_id']=$this->Auth->user('id');
			$this->request->data['Contacts']['active']=true;
			if($controller=='customers')$this->request->data['Contacts']['customer_id']=$id;
			if($controller=='vendors')$this->request->data['Contacts']['vendor_id']=$id;
// debug($this->request->data);exit;
			$this->Contacts->create();
			if ($this->Contacts->save($this->request->data)) {
				$this->Session->setFlash(__('The contact has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('controller'=>$controller,'action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
			}
		}
		//get customer or vendor name
		if($controller=='customers') {
			//lookup customer name
			$cust=$this->Contacts->Customer->field('name',array('Customer.id'=>$id));
			if(!$cust) throw new NotFoundException(__('Invalid customer'));
			$this->set('name','Customer: '.$cust);
		} else {
			//lookup vendor name
			$vendor=$this->Contacts->Vendor->field('name',array('Vendor.id'=>$id));
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
		$this->set('formName','Edit Contact');
		$this->Contacts->id = $id;
		if (!$this->Contacts->exists()) {
			throw new NotFoundException(__('Invalid contact'));
		}
		$contact=$this->Contacts->read(null, $id);
		if($contact['Customer']['name']) {
			//contact id for a customer
			$this->set('name','Customer: '.$contact['Customer']['name']);
			$controller='customers';
			$return_id=$contact['Customer']['id'];
		}//endif
		if($contact['Vendor']['name']) {
			$this->set('name','Vendor: '.$contact['Vendor']['name']);
			$controller='vendors';
			$return_id=$contact['Vendor']['id'];
		}//endif
		if ($this->request->is('post') || $this->request->is('put')) {
			//start new contact
			unset($this->request->data['Contact']['id']);
			$this->request->data['Contact']['created_id']=$this->Auth->user('id');
			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				//set old contact to deleted
				$this->Contact->save(array('Contact'=>array('id'=>$id,'active'=>false)));
				$this->Session->setFlash(__('The contact has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('controller'=>$controller,'action' => 'edit',$return_id));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
			}//endif
			$this->request->data['Contact']['id']=$id;
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
		$this->set('formName','Edit Contact');
		$this->Contact->id = $id;
		if (!$this->Contact->exists()) {
			throw new NotFoundException(__('Invalid address'));
		}
		$contact=$this->Contact->read(null, $id);
		if($contact['Customer']['id']) {
			//contact id for a customer
			$controller='customers';
			$return_id=$contact['Customer']['id'];
		}//endif
		if($contact['Vendor']['id']) {
			//copntact id is for a vendor
			$controller='vendors';
			$return_id=$contact['Vendor']['id'];
		}//endif

		if ($this->Contact->save(array('active'=>false))) {
			$this->Session->setFlash(__('Contact deleted'));
			$this->redirect(array('controller'=>$controller,'action' => 'edit',$return_id));
		}
		$this->Session->setFlash(__('Contact was not deleted'));
		$this->redirect(array('controller'=>$controller,'action' => 'edit',$return_id));
	}
}
