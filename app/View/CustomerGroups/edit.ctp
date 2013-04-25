<div class="customerGroups form">
<?php echo $this->Form->create('CustomerGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Customer Group: ').$this->request->data['CustomerGroup']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('id'=>'sc'));
// 		echo $this->Form->input('Item');
// 		echo $this->Form->input('Service');
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>