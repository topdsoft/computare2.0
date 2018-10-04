<div class="timeRecords form">
<?php echo $this->Form->create('TimeRecord'); ?>
	<fieldset>
		<legend><?php echo __('Edit Time Record'); ?></legend>
	<?php
		echo $this->Form->input('created');
		echo $this->Form->input('user_id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('duration',array('label'=>'Duration (hrs)'));
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Time Records'), array('controller'=>'timeRecords','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
