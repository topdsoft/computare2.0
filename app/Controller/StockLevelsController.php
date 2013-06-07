<?php
App::uses('AppController', 'Controller');
/**
 * StockLevels Controller
 *
 * @property StockLevel $StockLevel
 */
class StockLevelsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Stock Levels');
		$this->set('add_menu',true);
		$this->StockLevel->recursive = 0;
		$this->set('stockLevels', $this->paginate(array('StockLevel.active')));
		//get user list
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
		$this->set('formName','View Stock Level');
		$this->StockLevel->id = $id;
		if (!$this->StockLevel->exists()) {
			throw new NotFoundException(__('Invalid stock level'));
		}
		$level=$this->StockLevel->read(null, $id);
		$this->set('stockLevel', $level);
		//get any revisions
		$this->set('revisions',$this->StockLevel->find('all',array('recursive'=>-1,'order'=>'StockLevel.id desc','conditions'=>array('item_id'=>$level['StockLevel']['item_id'],'location_id'=>$level['StockLevel']['location_id'],'StockLevel.active'=>false))));
		//get user list
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Add Stock Level');
		if ($this->request->is('post')) {
			//respond to post data
			$this->request->data['StockLevel']['active']=true;
			$this->request->data['StockLevel']['created_id']=$this->Auth->user('id');
			$old=$this->StockLevel->find('first',array('recursive'=>-1,'conditions'=>array('item_id'=>$this->request->data['StockLevel']['item_id'],'location_id'=>$this->request->data['StockLevel']['location_id'],'active')));
			if($old) {
				//allready a stock level here
				$old['StockLevel']['active']=false;
				$old['StockLevel']['removed']=date('Y-m-d h:m:s');
				$old['StockLevel']['removed_id']=$this->Auth->user('id');
				$this->StockLevel->save($old);
			}//endif
			$this->StockLevel->create();
			if ($this->StockLevel->save($this->request->data)) {
				$this->Session->setFlash(__('The stock level has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stock level could not be saved. Please, try again.'));
			}
		}
		$locations = $this->StockLevel->Location->find('list');
		$items = $this->StockLevel->Item->find('list');
		$this->set(compact('locations', 'items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $item_id
 * @param string $location_id
 * @return void
 */
	public function edit($item_id = null,$location_id = null) {
		$this->set('formName','Edit Stock Level');
		$this->StockLevel->Location->id = $location_id;
		if (!$this->StockLevel->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->StockLevel->Item->id=$item_id;
		if (!$this->StockLevel->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//process save
			$old=$this->StockLevel->find('first',array('conditions'=>array('item_id'=>$item_id,'location_id'=>$location_id,'StockLevel.active')));
			if($old) {
				//remove old level
				$old['StockLevel']['active']=false;
				$old['StockLevel']['removed']=date('Y=m=d h:m:s');
				$old['StockLevel']['removed_id']=$this->Auth->user('id');
				$this->StockLevel->save($old);
			}//endif
			$this->request->data['StockLevel']['item_id']=$item_id;
			$this->request->data['StockLevel']['location_id']=$location_id;
			$this->request->data['StockLevel']['created_id']=$this->Auth->user('id');
			$this->request->data['StockLevel']['active']=true;
			unset($this->request->data['StockLevel']['id']);
			$this->StockLevel->create();
			if ($this->StockLevel->save($this->request->data)) {
				//saved ok
				$this->Session->setFlash(__('The stock level has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect']))  $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				//problem
				$this->Session->setFlash(__('The stock level could not be saved. Please, try again.'));
			}//endif
		} else {
			//set defaults
			$this->request->data = $this->StockLevel->find('first',array('conditions'=>array('item_id'=>$item_id,'location_id'=>$location_id,'StockLevel.active')));
			$this->request->data['StockLevel']['priority']=0;
		}
		//get current qty
		$this->set('current',$this->StockLevel->Location->ItemsLocation->find('first',array('conditions'=>array('item_id'=>$item_id,'location_id'=>$location_id))));
		$this->set('itemName',$this->StockLevel->Item->field('name',array('id'=>$item_id)));
		$this->set('locationName',$this->StockLevel->Location->field('name',array('id'=>$location_id)));
	}

}
