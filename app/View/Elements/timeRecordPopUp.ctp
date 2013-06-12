<?php 
/**
 * timeRecordPopUp.ctp
 * Used to show the time record popup
 */
?>
<span>

	<a href="#" onclick="window.open('<?php echo $this->Html->url(array('controller'=>'timeRecords','action'=>'popup')); ?>',
	'popup','width=500,height=600,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0');
	return false">Time</a>
</span>