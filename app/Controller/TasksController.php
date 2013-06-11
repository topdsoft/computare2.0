<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 */
class TasksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Tasks');
		$this->set('add_menu',true);
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
		$this->set('users',array(null=>'')+ClassRegistry::init('User')->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('formName','Task Details');
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		//get task data
		$task=$this->Task->read(null, $id);
		//get time data
		foreach($task['User'] as $i=>$user) {
			//loop for all users and get time data
			$task['User'][$i]['time']=$this->Task->TimeRecord->field('sum(duration)',array('user_id'=>$user['id'],'task_id'=>$id));
		}//end foreach
		$this->set('task', $task);
		$this->set('users',array(null=>'')+ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 * @param $project_id  (optional)
 */
	public function add($project_id=null) {
		//validate $project_id
		if($project_id) {
			//get project data
			$project=$this->Task->Project->read(null,$project_id);
			if(!$project || $project['Project']['finished']) {
				//invlaid project
				$this->Session->setFlash(__('Invalid or finished project.'));
				$this->redirect(array('action' => 'index'));
			}//endif
			$this->set('project',$project);
		}//endif
		$this->set('formName','New Task');
		$this->set('add_menu',true);
		if ($this->request->is('post')) {
			//process submit click
			if($project_id) $this->request->data['Task']['project_id']=$project_id;
			$this->request->data['Task']['active']=true;
			$this->request->data['Task']['created_id']=$this->Auth->user('id');
debug($this->request->data);exit;
			$this->Task->create();
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved'),'default',array('class'=>'success'));
				if(isset($this->passedArgs['redirect'])) $this->redirect($this->passedArgs['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
			}
		}
		$projects = $this->Task->Project->find('list',array('conditions'=>array('Project.finished'=>null)));
		$users = $this->Task->User->find('list');
		$this->set(compact('projects', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('formName','Edit Task');
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Task->read(null, $id);
		}
		$projects = $this->Task->Project->find('list');
		$users = $this->Task->User->find('list');
		$this->set(compact('projects', 'users'));
	}

/**
 * finish method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function finish($id = null) {
		$this->set('formName','Finish Task');
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		//get task data
		$task=$this->Task->read();
		if($task['Task']['finished'] || !$task['Task']['active']) {
			//allready finished
			$this->Session->setFlash(__('Task allready Finished'));
			$this->redirect(array('action' => 'index'));
		}//endif
		$task['Task']['finished']=date('Y-m-d h:m:s');
		$task['Task']['finished_id']=$this->Auth->user('id');
		if ($this->Task->save($task)) {
			$this->Session->setFlash(__('Task marked Finished'),'default',array('class'=>'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Task was not marked finished'));
		$this->redirect(array('action' => 'index'));
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
		$this->set('formName','Remove Task');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		//get task data
		$task=$this->Task->read();
		if($task['Task']['finished']) {
			//allready finished
			$this->Session->setFlash(__('Task allready Finished so it can not be Removed'));
			$this->redirect(array('action' => 'index'));
		}//endif
		$task['Task']['removed']=date('Y-m-d h:m:s');
		$task['Task']['removed_id']=$this->Auth->user('id');
		$task['Task']['active']=false;
		if ($this->Task->save($task)) {
			$this->Session->setFlash(__('Task removed'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Task was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
