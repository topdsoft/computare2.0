<?php
App::uses('AppController', 'Controller');
/**
 * Backups Controller
 *
 * @property Backup $Backup
 */
class BackupsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('formName','List Backups');
		$this->set('add_menu',true);
		$this->set('helplink','/pages/backups#l');
		$this->Backup->recursive = 0;
		$this->set('backups', $this->paginate());
		$this->set('users',ClassRegistry::init('User')->find('list'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('formName','Perform Backup');
		$this->set('add_menu',true);
		$this->set('helplink','/pages/backups#a');
		if ($this->request->is('post')) {
			//backup company DB
			$dataSource=$this->Backup->getDataSource();
			$username=$dataSource->config['login'];
			$password=$dataSource->config['password'];
			$dbName = Configure::read('Company');
			$filename=date('Y-m-d_hms').'.sql';
			//check for correct folder
//			$path='files/'.$dbName;
			$path='files/'.$dbName.'/'.ClassRegistry::init('Programsetting')->field('backup_file_dir');
			if(!is_dir($path)) debug(mkdir($path));
			//create file
			$cmd="mysqldump --user $username -p$password $dbName > $path/$filename";
			$out=shell_exec($cmd);
// debug($out);debug($dbName);exit;
			$this->request->data['Backup']['created_id']=$this->Auth->user('id');
			$this->request->data['Backup']['filename']=$path.'/'.$filename;
			//verify file
			$ok=file_exists($this->request->data['Backup']['filename']);
			$this->Backup->create();
			if ($ok && $this->Backup->save($this->request->data)) {
				$this->Session->setFlash(__('The backup has been saved'),'default',array('class'=>'success'));
				if(isset($this->request->params['named']['redirect'])) $this->redirect($this->request->params['named']['redirect']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The backup failed. Please, try again.'));
			}
		}
	}

}
