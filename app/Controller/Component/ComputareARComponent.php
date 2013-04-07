<?php
/**
 * ComputareARComponent.php
 * 
 * Part of computare accounting system used to edit accounts receivable
 * */

App::uses('Component','Controller');
class ComputareARComponent extends Component{
	
	public $components = array('Auth', 'Session', 'Cookie');
	
}