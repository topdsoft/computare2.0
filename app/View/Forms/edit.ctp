<div class="forms form">
<?php echo $this->Form->create('Form'); ?>
	<fieldset>
		<legend><?php echo __('Edit Form'); ?></legend>
	<?php
		echo $this->Form->input('id');
//		echo $this->Form->input('created_id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
		echo $this->Form->input('type');
		echo $this->Form->input('helplink');
//		echo $this->Form->input('Group');
//		echo $this->Form->input('Menu');
//		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
