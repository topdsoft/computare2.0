<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Issue Item: ').$itemLocation['Item']['name'];?></legend>
	<?php
// debug($item);
		if($itemLocation['Item']['serialized']) {
			//show list of serial numbers
			echo $this->Form->input('serialNumbers',array('label'=>'Select Items to Issue','multiple'=>'checkbox'));
		} else echo $this->Form->input('qty',array('type'=>'number','id'=>'sc','min'=>1,'max'=>$itemLocation['ItemsLocation']['qty']));
// 		echo $this->Form->input('cost',array('id'=>'sc'));
		echo 'From Location: <strong>'.$itemLocation['Location']['name'].'</strong>';
		echo $this->Form->input('issueType_id');
		echo $this->Form->input('note',array('label'=>'Note (optional)'));
// 		if($item['Item']['serialized']) echo $this->Form->input('ItemSerialNumber.number',array('label'=>'Serial Number'));
// debug($this->data);
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>