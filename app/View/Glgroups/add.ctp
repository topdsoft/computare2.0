<div class="glgroups form">
<?php echo $this->Form->create('Glgroup'); ?>
	<fieldset>
		<legend><?php echo __('Create GL Account Group'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>