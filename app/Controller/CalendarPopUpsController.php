<?php
App::uses('AppController', 'Controller');
/**
 * CalendarPopUps Controller
 *
 * @property CalendarPopUp $CalendarPopUp
 */
class CalendarPopUpsController extends AppController {

/** popup method
 * 
 *  should only be called from the calendarPopUp element
 */
	public function popup($year=null,$month=null) {
		//show user's popup calendar
// debug($this->passedArgs);exit;
		$this->set('formName','Calendar Pop Up');
		$calendar=$this->CalendarPopUp->find('first',array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
		if(!$calendar) {
			//user has never used this popup before
			$this->CalendarPopUp->save(array('user_id'=>$this->Auth->user('id')));
			$calendar=$this->CalendarPopUp->read(null);
		}//endif
		//parse passed args
		
		if(!$month) $month=date('m');
		if(!$year) $year=date('Y');
		//get list of years
		$sYear=$year-5;
		$eYear=$year+5;
		for($i=$sYear; $i<=$eYear; $i++) $years[$i]=$i;
//		$years=range($sYear,$eYear);
		//get list of months
		for($i=1; $i<=12; $i++) $months[$i]=strftime('%B', mktime(0,0,0,$i,1));
		//get days in month
		$daysInMonth=date('t',mktime(0,0,0,$month,1,$year));
		//get week names
		for($i=1; $i<=7; $i++) $days[$i]=strftime('%a', mktime(0,0,0,3,28+$i,2009));
		//get first day of week
		$firstDay=date('w',mktime(0,0,0,$month,1,$year));
		//get week number for 1st week of month
		$weekNumber=date('W',mktime(0,0,0,$month,2,$year));
		//figure out if today is included
		if($year==date('Y') && $month==date('m')) $today=date('d');
		else $today=0;
		
		$this->set(compact('years','months','days','daysInMonth','firstDay','weekNumber','month','year','today'));
		//set current values
		$this->request->data['Calendar']['year_id']=$year;
		$this->request->data['Calendar']['month_id']=$month;
		$this->layout='popup';
//debug($firstDay);exit;
	}
}
