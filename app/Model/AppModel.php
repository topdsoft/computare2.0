<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	function __construct($id = false, $table = null, $ds = null) { 
		// Get saved company that is used for the database name 
		$dbName = Configure::read('Company'); //$dbName='computare';
//debug($dbName);exit;
		// Get common company-specific config (default settings in database.php) 
		$config = ConnectionManager::getDataSource('default')->config; 
		// Set correct database name 
		$config['database'] = $dbName;// echo 'here:'.$dbName;// exit;
//debug($config); exit();
		// Add new config to registry 
		$ret=ConnectionManager::create($dbName, $config); 
//debug($ret);exit;
		// Point model to new config 
		$this->useDbConfig = $dbName; 
// 		$this->useDbConfig = 'default'; //uncomment this line to use bake
		parent::__construct($id, $table, $ds); 
	} 
	
/**
 * protected function getSchema (?sp)
 * pre:none
 * mods:if schema not set set it to 0
 * post: return schema
 */
	protected function getSechema() {
		//get schema # from table comments
		$q=$this->query('show table status where Name="'.$this->table.'"');
		$schema=$q[0]['TABLES']['Comment'];
		if($schema==='') {
			//schema not set
			$this->setSchema(0);
		}//endif
		return $schema;
	}
	
	/**
	 * protected function setSchema
	 * pre:int schema to set
	 * mods:table comment is set to schema #
	 * post:results
	 */
	protected function setSchema($schema) {
		//set table comment to correct schema
		return $this->query('alter table '.$this->table.' COMMENT="'.$schema.'"');
	}
}
