<div class="glaccounts form">
<?php echo $this->Form->create('Glaccount'); ?>
	<fieldset>
		<legend><?php echo __('Add Glaccount'); ?></legend>
	<?php
		echo $this->Form->input('created_id');
		echo $this->Form->input('glaccountdetail_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Glaccounts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Glaccountdetails'), array('controller' => 'glaccountdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccountdetail'), array('controller' => 'glaccountdetails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glentries'), array('controller' => 'glentries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glentry'), array('controller' => 'glentries', 'action' => 'add')); ?> </li>
	</ul>
</div>
