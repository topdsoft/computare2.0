<div class="pages index">
<?php //echo $this->Form->create('Page');?>

<h2>computāre Help Index</h2>
<?php
	//show all pages
	foreach($helpdata as $i=>$data) {
		//loop for all entries
		echo '<p>';
		echo $this->Html->link(__(($i+1).' '.$data['name']),array('action'=>'',$data['id']),array('style'=>'font-size: 120%;'));
		//loop for all anchors
		$j=1;
		foreach ($data['anchors'] as $ai=>$anchor) echo '<br>&nbsp'.$this->Html->link(__(($i+1).'.'.($j++).' '.$anchor),array('#'=>$ai,'action'=>'',$data['id']));
		echo '</p>';
	}
?>

</div>
