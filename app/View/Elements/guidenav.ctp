<br><br>
<?php
	if($helpdata['prev']) echo $this->Html->link(__('<<Previous: '.$helpdata['prev']['name']),array('action'=>'',$helpdata['prev']['id'])).' ';
	echo $this->Html->link(__('Index'),array('action'=>''));
	if($helpdata['next']) echo ' '.$this->Html->link(__('Next: '.$helpdata['next']['name'].'>>'),array('action'=>'',$helpdata['next']['id']));
?>
