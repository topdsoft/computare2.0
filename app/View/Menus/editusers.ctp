<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Edit Users for Menu:'.$this->Form->value('Menu.name')); ?></legend>
	<?php
		echo $this->Form->input('id');
//		echo $this->Form->input('name');
//		echo $this->Form->input('user_id');
//		echo $this->Form->input('Form');
		echo $this->Form->input('User',array('multiple'=>'checkbox','label'=>''));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
