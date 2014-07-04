<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Create New Menu'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('user_id');
//		echo $this->Form->input('Form');
//		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('MenuName').focus();</script>