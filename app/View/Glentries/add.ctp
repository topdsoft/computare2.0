<div class="glentries form">
<?php echo $this->Form->create('Glentry'); ?>
	<fieldset>
		<legend><?php echo __('Add Glentry'); ?></legend>
	<?php
		echo $this->Form->input('created_id');
		echo $this->Form->input('postDate');
		echo $this->Form->input('glaccount_id');
		echo $this->Form->input('glcheck_id');
		echo $this->Form->input('debit');
		echo $this->Form->input('credit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Glentries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Glaccounts'), array('controller' => 'glaccounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccount'), array('controller' => 'glaccounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glchecks'), array('controller' => 'glchecks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glcheck'), array('controller' => 'glchecks', 'action' => 'add')); ?> </li>
	</ul>
</div>
