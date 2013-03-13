<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User ID:'.$this->data['User']['id']); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
//		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('homepage');
		echo $this->Form->input('UserGroup',array('label'=>'Set User Groups'));
//debug($UserGroups);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
