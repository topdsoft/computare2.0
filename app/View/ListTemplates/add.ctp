<div class="listTemplates form">
<?php echo $this->Form->create('ListTemplate'); ?>
	<fieldset>
		<legend><?php echo __('Add List Template'); ?></legend>
	<?php
		echo $this->Form->input('created_id');
		echo $this->Form->input('active');
		echo $this->Form->input('removed');
		echo $this->Form->input('removed_id');
		echo $this->Form->input('newList_id');
		echo $this->Form->input('name');
		echo $this->Form->input('linkedTo_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List List Templates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List List Questions'), array('controller' => 'list_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New List Question'), array('controller' => 'list_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
