<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Receive Item: ').$item['Item']['name'];?></legend>
	<?php
		echo $this->Form->input('qty',array('id'=>'sc'));
		echo $this->Form->input('cost');
		echo $this->Form->input('location_id');
		echo $this->Form->input('purchaseOrder_id');
// 		echo $this->Form->input('ItemGroup');
// debug($this->data);
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>