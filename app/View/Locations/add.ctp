<div class="locations form">
<?php echo $this->Form->create('Location'); ?>
	<fieldset>
		<legend><?php echo __('Add Location'); ?></legend>
	<?php
		echo $this->Form->input('locationDetail_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('Item');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Location Details'), array('controller' => 'location_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location Detail'), array('controller' => 'location_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
