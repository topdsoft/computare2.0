<div class="contacts form">
<?php echo $this->Form->create('Contact'); ?>
	<fieldset>
		<legend><?php echo __('Add Contact to '.$name); ?></legend>
	<?php
		echo $this->Form->input('field_name',array('label'=>'Description (EX: Website, Phone Number)','id'=>'sc'));
		echo $this->Form->input('value');
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>