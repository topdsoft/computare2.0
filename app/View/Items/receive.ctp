<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Receive Item: ').$item['Item']['name'];?></legend>
	<?php
// debug($item);
		if($item['Item']['serialized']) echo $this->Form->input('qty',array('value'=>1,'disabled'=>true,'label'=>'Qty (1 for serialized item)'));
		else echo $this->Form->input('qty',array('id'=>'sc'));
		echo $this->Form->input('cost',array('id'=>'sc'));
		echo $this->Form->input('location_id');
		echo $this->Form->input('purchaseOrder_id');
 		if($item['Item']['serialized']) echo $this->Form->input('ItemSerialNumber.number',array('label'=>'Serial Number'));
// debug($this->data);
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>