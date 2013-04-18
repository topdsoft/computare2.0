<?php
App::uses('AppController', 'Controller');
/**
 * CustomerPopUps Controller
 *
 * @property CustomerPopUp $CustomerPopUp
 */
class CustomerPopUpsController extends AppController {

	public function popup() {
		$this->Customer=ClassRegistry::init('Customer');
		$this->Customer->recursive=0;
		$conditions=array('Customer.active');
		if ($this->request->is('post') || $this->request->is('put')) {
			//filter customers
			$search=array('lastName','firstName','company');
			foreach($search as $s) {
				//loop for all search items
				if(!empty($this->request->data['Customer'][$s])) $conditions["CustomerDetail.$s LIKE"]='%'.$this->request->data['Customer'][$s].'%';
			}//endforeach
// debug($this->request->data);exit;
		}//endif
		
		$customers=$this->paginate('Customer',$conditions);
		$this->set(compact('customers'));
		$this->layout='popup';
	}

}
