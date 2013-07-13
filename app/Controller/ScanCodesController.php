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
		//get user list and send to index
		$this->set('users',$this->ScanCode->User->find('list'));
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
			$this->request->data['ScanCode']['item_id']=$id;
		} elseif($type=='locations') {
			//validate location
			$name=$this->ScanCode->Location->field('name',array('id'=>$id));
			if(!$name) throw new NotFoundException(__('Invalid location'));
			$this->request->data['ScanCode']['location_id']=$id;
		} elseif($type=='users') {
			//validate user
			$name=$this->ScanCode->User->field('username',array('id'=>$id));
			if(!$name) throw new NotFoundException(__('Invalid user'));
			$this->request->data['ScanCode']['user_id']=$id;
		} elseif($type=='itemSerialNumbers') {
			//validate serial number
			$sn=$this->ScanCode->ItemSerialNumber->find('first',array('conditions'=>array('ItemSerialNumber.id'=>$id),'fields'=>array('Item.name','ItemSerialNumber.number')));
			if(!$sn) throw new NotFoundException(__('Invalid serial number'));
			$name=$sn['Item']['name'].' SN:'.$sn['ItemSerialNumber']['number'];
			unset($sn);
			$this->request->data['ScanCode']['itemSerialNumber_id']=$id;
		}//endif
		if ($this->request->is('post')) {
			//save scan code
			if($this->request->data['ScanCode']['internal']) {
				//create scan code
				$last=$this->ScanCode->find('first',array('conditions'=>array('internal')));
				if($last) {
					//increment scan code
					$code=intval($last['ScanCode']['code']);
					$code++;
					$this->request->data['ScanCode']['code']=str_pad($code,7,'0',STR_PAD_LEFT);
					unset($code);
				} else {
					//initialize scan codes
					$this->request->data['ScanCode']['code']='0000000';
				}//endif
				unset($last);
			}//endif
			$this->request->data['ScanCode']['created_id']=$this->Auth->user('id');
// debug($this->request->data);exit;
			$this->ScanCode->create();
			if ($this->ScanCode->save($this->request->data)) {
				$this->Session->setFlash(__('The scan code has been saved'),'default',array('class'=>'success'));
				if(isset($this->params['named']['redirect'])) $this->redirect($this->params['named']['redirect']);
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
	public function lookup() {
		$this->set('formName','Scan Code Lookup');
		if ($this->request->is('post') || $this->request->is('put')) {
			//lookup code
			$code=$this->ScanCode->find('first',array('conditions'=>array('ScanCode.code'=>$this->request->data['ScanCode']['code'])));
			if($code) {
				//loopup successfull
				if($code['ScanCode']['item_id']) $this->redirect(array('controller'=>'items','action'=>'view',$code['ScanCode']['item_id']));
				if($code['ScanCode']['location_id']) $this->redirect(array('controller'=>'locations','action'=>'view',$code['ScanCode']['location_id']));
				if($code['ScanCode']['user_id']) $this->redirect(array('controller'=>'users','action'=>'view',$code['ScanCode']['user_id']));
				if($code['ScanCode']['itemSerialNumber_id']) $this->redirect(array('controller'=>'itemSerialNumbers','action'=>'view',$code['ScanCode']['itemSerialNumber_id']));
			}//endif
// debug($code);exit;
			$this->Session->setFlash(__('The scan code could not be found. Please, try again.'));
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
