<?php
App::uses('AppModel', 'Model');
/**
 * ImageSetting Model
 *
 */
class ImageSetting extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'imageSettings';

	public $order='id desc';
}
