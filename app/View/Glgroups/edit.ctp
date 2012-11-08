<div class="glgroups form">
<?php echo $this->Form->create('Glgroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Glgroup'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('created_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Glgroup.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Glgroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Glgroups'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Glaccountdetails'), array('controller' => 'glaccountdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccountdetail'), array('controller' => 'glaccountdetails', 'action' => 'add')); ?> </li>
	</ul>
</div>
