<div class="tasks form">
<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Add User to Task: ').$task['Task']['name']; ?></legend>
	<?php
//		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
