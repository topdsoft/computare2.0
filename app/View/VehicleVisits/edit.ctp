<div class="vehicleVisits form">
<?php echo $this->Form->create('VehicleVisit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vehicle Visit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('created_id');
		echo $this->Form->input('exits');
		echo $this->Form->input('exit_id');
		echo $this->Form->input('vehicle_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VehicleVisit.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('VehicleVisit.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Vehicle Visits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
	</ul>
</div>
