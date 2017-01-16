<?php
App::uses('AppController', 'Controller');
/**
 * TimeRecords Controller
 *
 * @property TimeRecord $TimeRecord
 */
class TimeRecordsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Time Records');
		$this->set('add_menu',true);
		$this->TimeRecord->recursive = 0;
		$this->set('timeRecords', $this->paginate());
		//get project list
		$this->set('projects',$this->TimeRecord->Task->Project->find('list'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Time Record');
		$this->TimeRecord->id = $id;
		if (!$this->TimeRecord->exists()) {
			throw new NotFoundException(__('Invalid time record'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TimeRecord->save($this->request->data)) {
				$this->Session->setFlash(__('The time record has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time record could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TimeRecord->read(null, $id);
		}
		$users = $this->TimeRecord->User->find('list');
		$tasks = $this->TimeRecord->Task->find('list');
		$this->set(compact('users', 'tasks'));
	}
	
/**
 * popUp method
 * 
 */
	public function popup (){
		//get user and time record data
		$user=$this->TimeRecord->User->find('first',array('recursive'=>-1,'conditions'=>array('User.id'=>$this->Auth->user('id'))));
		$currentTime=date($user['User']['date_time_format']);
		$timeRecords=$this->TimeRecord->find('all',array('conditions'=>array('TimeRecord.user_id'=>$this->Auth->user('id'),'TimeRecord.created >'=>date('Y-m-d'))));
		$currentTask=$this->TimeRecord->find('first',array('conditions'=>array('TimeRecord.user_id'=>$this->Auth->user('id'),'TimeRecord.finished'=>null)));
		if($currentTask) $currentTask['Project']['name']=$this->TimeRecord->Task->Project->field('name',array('Project.id'=>$currentTask['Task']['project_id']));
		//find all tasks for this user
		$allTasks=$this->TimeRecord->Task->UsersTask->find('list',array('fields'=>'task_id','conditions'=>array('user_id'=>$this->Auth->user('id'))));
		$fields=array('Task.id','Task.name','Project.name');
		$activeUserTasks=$this->TimeRecord->Task->find('all',array('conditions'=>array('Task.id'=>$allTasks,'Task.finished'=>null,'Task.active'),'fields'=>$fields,'recursive'=>0));
		$tasks=array();
		foreach($activeUserTasks as $task) $tasks[$task['Task']['id']]='['.$task['Project']['name'].']'.$task['Task']['name'];
		$projects=$this->TimeRecord->Task->Project->find('list');
		if ($this->request->is('post') || $this->request->is('put')) {
			//process task change
//  debug($this->request);exit;
			if($currentTask) {
				//clock out from current task
				$currentTask['TimeRecord']['finished']=date('Y-m-d H:i:s');
				$currentTask['TimeRecord']['duration']=(time()-strtotime($currentTask['TimeRecord']['created']))/60/60;
				$this->TimeRecord->save($currentTask['TimeRecord']);
			}//endif
			if(isset($this->request->data['out'])) {
				//logging out
			} else {
				//start new task
				$this->TimeRecord->create();
				$this->TimeRecord->save(array('user_id'=>$this->Auth->user('id'),'task_id'=>$this->request->data['task_id']));
			}//endif
			//reload form
			$this->redirect(array('action'=>'popup'));
		}//endif
 		$this->layout='popup';
		$this->set(compact('user','currentTime','timeRecords','currentTask','tasks','projects'));
		//find users last task and make default
		$this->request->data['task_id']=$this->TimeRecord->field('task_id',array('user_id'=>$this->Auth->user('id')));
	}
}
