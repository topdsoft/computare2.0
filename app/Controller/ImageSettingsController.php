<?php
App::uses('AppController', 'Controller');
/**
 * ImageSettings Controller
 *
 * @property ImageSetting $ImageSetting
 */
class ImageSettingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','View Image Settings');
		$this->set('add_menu',true);
		$this->ImageSetting->recursive = 0;
		$this->set('imageSettings', $this->paginate(array('active')));
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Image Setting');
		if ($this->request->is('post')) {
			//save initial directory
			$this->request->data['ImageSetting']['created_id']=$this->Auth->user('id');
			$this->request->data['ImageSetting']['active']=true;
			//check for trailing '/'
#TODO
			$this->ImageSetting->create();
			if ($this->ImageSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The image directory has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image directory could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Image Settings');
		$this->ImageSetting->id = $id;
		if (!$this->ImageSetting->exists()) {
			throw new NotFoundException(__('Invalid image setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//check for trailing '/'
#TODO
			//check that change has been made
			if($this->request->data['ImageSetting']['image_dir']!=$this->ImageSetting->field('image_dir')) {
				//directory has been changed
				$dataSource=$this->ImageSetting->getDataSource();
				//start transaction
				$dataSource->begin();
				$ok=true;
				//remove old record
				$old=$this->ImageSetting->read();
				$old['ImageSetting']['removed']=date('Y-m-d H:i:s');
				$old['ImageSetting']['removed_id']=$this->Auth->user('id');
				$old['ImageSetting']['active']=false;
				if($ok) $ok=$this->ImageSetting->save($old);
				unset($old);
				//save new record
				if($ok) $this->ImageSetting->create();
				$this->request->data['ImageSetting']['created_id']=$this->Auth->user('id');
				$this->request->data['ImageSetting']['active']=true;
				if($ok)$ok=$this->ImageSetting->save($this->request->data);
				if ($ok) {
					//saved ok
					$dataSource->commit();
					$this->Session->setFlash(__('The image directory has been saved'),'default',array('class'=>'success'));
					$this->redirect(array('action' => 'index'));
				} else {
					//failed ???
					$dataSource->rollback();
					$this->Session->setFlash(__('The image directory could not be saved. Please, try again.'));
				}//endif
			} else $this->redirect(array('action' => 'index'));
		} else {
			$this->request->data = $this->ImageSetting->read(null, $id);
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
		$this->set('formName','Remove Image Setting');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}//endif
		$this->ImageSetting->id = $id;
		if (!$this->ImageSetting->exists()) {
			throw new NotFoundException(__('Invalid image setting'));
		}//endif
		//remove setting
		if(count($this->ImageSetting->find('all',array('conditions'=>array('active'))))>1) {
			//must be at least one directory
			if($this->ImageSetting->save(array('active'=>false,'removed_id'=>$this->Auth->user('id'),'removed'=>date('Y-m-d H:i:s')))) {
				//removed ok
				$this->Session->setFlash(__('Image setting deleted'));
				$this->redirect(array('action' => 'index'));
			}//endif
		}//endif
		$this->Session->setFlash(__('Image setting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
