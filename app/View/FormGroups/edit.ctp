<div class="formGroups form">
<?php echo $this->Form->create('FormGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Form Group: ').$this->data['FormGroup']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('id'=>'sc'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>