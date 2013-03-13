<div class="groups form">
<?php echo $this->Form->create('UserGroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Group'); ?></legend>
	<?php
//		echo $this->Form->input('created_id');
		echo $this->Form->input('name',array('id'=>'sc'));
//		echo $this->Form->input('Form');
//		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>