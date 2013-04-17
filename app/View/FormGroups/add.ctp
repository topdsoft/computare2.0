<div class="formGroups form">
<?php echo $this->Form->create('FormGroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Form Group'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>