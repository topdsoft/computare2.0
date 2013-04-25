<div class="customerGroups form">
<?php echo $this->Form->create('CustomerGroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Customer Group'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>