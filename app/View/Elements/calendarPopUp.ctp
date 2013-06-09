<?php 
/**
 * calendarPopUp.ctp
 * Used to show the calendar popup
 * should be passed:
	* imputId=>the id of input element that will get the date user selects from the pop up
 */
?>
 <span class="filtercalendar" onclick="window.open('<?php echo $this->Html->url(array('controller'=>'calendarPopUps','action'=>'popup','inputId'=>$inputId)); ?>',
	'popup','width=280,height=260,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0');
	return false">

	 <?php
		echo '<span class="sm">'.date('M').'</span><br>';
		echo '<span class="day">'.date('j').'</span><br>';
		echo '<span class="sm">'.date('D').'</span>';
	 ?>
</span>