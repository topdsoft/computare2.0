<?php
App::uses('AppController', 'Controller');
/**
 * WorkflowChains Controller
 *
 * @property WorkflowChain $WorkflowChain
 */
class WorkflowChainsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Workflow Chains');
		$this->set('add_menu',true);
		$this->WorkflowChain->recursive = 0;
		$this->set('workflowChains', $this->paginate());
		//get user data
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
		$this->set('formName','View Workflow Chain');
		$this->WorkflowChain->id = $id;
		if (!$this->WorkflowChain->exists()) {
			throw new NotFoundException(__('Invalid workflow chain'));
		}
		$this->set('workflowChain', $this->WorkflowChain->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','New Workflow Chain');
		if ($this->request->is('post')) {
			//saving
			$this->WorkflowChain->create();
			$this->request->data['WorkflowChain']['created_id']=$this->Auth->user('id');
			$this->request->data['WorkflowChain']['active']=true;
			if ($this->WorkflowChain->save($this->request->data)) {
				//validation ok
				$this->Session->setFlash(__('The workflow chain has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$this->WorkflowChain->getInsertId()));
			} else {
				//validation failed
				$this->Session->setFlash(__('The workflow chain could not be saved. Please, try again.'));
			}//endif
		} else {
			//get defaults
			$this->request->data['WorkflowChain']=$this->passedArgs;
		}//endif
	}

/**
 * addlink method
 *
 * @return void
 */
	public function addlink($id=null) {
		$this->set('formName','Add Workflow Link');
		//verify id
		$this->WorkflowChain->id = $id;
		if (!$this->WorkflowChain->exists()) {
			throw new NotFoundException(__('Invalid workflow chain'));
		}
		if ($this->request->is('post')) {
			$this->WorkflowChain->Link->create();
			$this->request->data['Link']['created_id']=$this->Auth->user('id');
			$this->request->data['Link']['active']=true;
			$this->request->data['Link']['workflowChain_id']=$id;
			if ($this->WorkflowChain->Link->save($this->request->data)) {
				$this->Session->setFlash(__('The link has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'));
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
		$this->set('formName','Edit Workflow Chain');
		$this->WorkflowChain->id = $id;
		if (!$this->WorkflowChain->exists()) {
			throw new NotFoundException(__('Invalid workflow chain'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->WorkflowChain->save($this->request->data)) {
				$this->Session->setFlash(__('The workflow chain has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The workflow chain could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->WorkflowChain->read(null, $id);
		}
	}

/**
 * editlink method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function editlink($id = null) {
		$this->set('formName','Edit Workflow Link');
		$this->WorkflowChain->Link->id = $id;
		if (!$this->WorkflowChain->Link->exists()) {
			throw new NotFoundException(__('Invalid workflow link'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->WorkflowChain->Link->save($this->request->data)) {
				$this->Session->setFlash(__('The workflow link has been saved'),'default',array('class'=>'success'));
				//find chain_id
				$chain_id=$this->WorkflowChain->Link->field('workflowChain_id');
				$this->redirect(array('action' => 'edit',$chain_id));
			} else {
				$this->Session->setFlash(__('The workflow link could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->WorkflowChain->Link->read(null, $id);
		}
	}

/**
 * removelink method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function removelink($id = null) {
		$this->set('formName','Remove Workflow Link');
		$this->WorkflowChain->Link->id = $id;
		if (!$this->WorkflowChain->Link->exists()) {
			throw new NotFoundException(__('Invalid workflow link'));
		}
		$link=$this->WorkflowChain->Link->read();
		$link['Link']['removed']=date('Y-m-d H:i:s');
		$link['Link']['removed_id']=$this->Auth->user('id');
		$link['Link']['active']=false;
		if ($this->WorkflowChain->Link->save($link['Link'])) {
			$this->Session->setFlash(__('The workflow link has been deleted'));
		}//endif
		$this->redirect(array('action' => 'edit',$link['WorkflowChain']['id']));
	}

/**
 * run method
 * 
 * @param $id
 * @param $step
 * @param $new_id
 * @return void
 */
	public function run($id,$step=0,$new_id=null) {
		//run workflow chain
		$this->WorkflowChain->id = $id;
		if (!$this->WorkflowChain->exists()) {
			throw new NotFoundException(__('Invalid workflow chain'));
		}
		$chain = $this->WorkflowChain->read(null, $id);
		//check for passed new_id
		if(isset($this->request->params['named']['new_id'])) $new_id=$this->request->params['named']['new_id'];
		if($step<count($chain['Link'])) {
			//visit next step in chain
// 			$redirect=$chain['Link'][$step]['form'];
			$redirect=array('controller'=>$chain['Link'][$step]['controller'],'action'=>$chain['Link'][$step]['action']);
			//parse params
			if($chain['Link'][$step]['params']!='') {
				//params are set, check for new_id (##) or just use params as entered
				$chain['Link'][$step]['params']=str_replace('##',$new_id,$chain['Link'][$step]['params']);
				//parse out to arrays
				foreach(explode('/',$chain['Link'][$step]['params']) as $part) {
					//loop for all parts of parameters
					if(count(explode(':',$part))==2) {
						//explode named param
						list($i,$d)=explode(':',$part);
						$redirect+=array($i=>$d);
						unset($i);
						unset($d);
					} else {
						//not a named param
						$redirect+=array($part);
					}//endif
				}//end foreach
//				$redirect+=array($chain['Link'][$step]['params']);
// debug($chain['Link'][$step]);debug($this->request->params['named']);debug($redirect);exit;
			}//endif
			if($new_id) $redirect+=array('redirect'=>array('controller'=>'workflowChains','action'=>'run',$id,$step+1,$new_id));
			else $redirect+=array('redirect'=>array('controller'=>'workflowChains','action'=>'run',$id,$step+1));
			$this->redirect($redirect);
		}//endif
		//done with chain
		$this->redirect($chain['WorkflowChain']['return_form']);
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
		$this->set('formName','Remove Workflow Chain');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->WorkflowChain->id = $id;
		if (!$this->WorkflowChain->exists()) {
			throw new NotFoundException(__('Invalid workflow chain'));
		}
		$chain=$this->WorkflowChain->read();
		$chain['WorkflowChain']['removed']=date('Y-m-d H:i:s');
		$chain['WorkflowChain']['removed_id']=$this->Auth->user('id');
		$chain['WorkflowChain'][active]=false;
		if ($this->WorkflowChain->save($chain)) {
			$this->Session->setFlash(__('Workflow chain deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Workflow chain was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
