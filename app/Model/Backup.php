<?php
App::uses('AppModel', 'Model');
/**
 * Backup Model
 *
 */
class Backup extends AppModel {
	public $order='id desc';
	
	public $virtualFields= array(
		'since'=>'concat(TIMESTAMPDIFF(DAY,created,now()),"d ",TIMESTAMPDIFF(HOUR,created,now())-TIMESTAMPDIFF(DAY,created,now())*24,"h")',
	);
}
