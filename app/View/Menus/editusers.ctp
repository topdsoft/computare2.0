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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Menu.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Menu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
