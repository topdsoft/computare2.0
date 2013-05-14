<?php
App::uses('AppController', 'Controller');
/**
 * Glslots Controller
 *
 * @property Glslot $Glslot
 */
class GlslotsController extends AppController {

	public $components=array('ComputareGL');

/**
 * edit method
 * 
 * used to edit what glaccounts connect to what glslots
 */

	public function edit(){
		$this->set('formName','Connect GL Accounts');
		$this->set('helplink','/pages/glslots');
		$this->Glaccount=ClassRegistry::init('Glaccount');
		//get slot data
		$slots=$this->Glslot->find('all',array('conditions'=>array('Glslot.active')));
		if ($this->request->is('post') || $this->request->is('put')) {
			//returning from form
			foreach($this->request->data['Glslot'] as $slot=>$glaccount) {
				//loop for all slots returned
				$this->ComputareGL->saveSlot($slot,$glaccount);
			}//end foreach
			$this->Session->setFlash(__('Account settings have been saved'),'default',array('class'=>'success'));
			$this->redirect(array('controller'=>'glaccounts'));
// debug($this->request->data);exit;
		} else {
			//setup data for form
// debug($slots);exit;
			foreach($slots as $slot) {
				//loop for each defined slot and add to form data
				$this->request->data['Glslot'][$slot['Glslot']['slot']]=$slot['Glslot']['glaccount_id'];
			}//end foreach
		}//endif
		$glaccounts=array(0=>'(none)')+$this->Glaccount->find('list');
		$this->set(compact('slots','glaccounts'));
		$this->Session->setFlash(__('The settings on this form are meant for one time system setup. Changes here can have unexpected results on a working system.'),'default',array('class'=>'notice'));
	}
}
