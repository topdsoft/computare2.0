<div class="vehicleVisits view">
<h2><?php echo __('Vehicle Visit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vehicleVisit['VehicleVisit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vehicleVisit['VehicleVisit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($vehicleVisit['VehicleVisit']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exits'); ?></dt>
		<dd>
			<?php echo h($vehicleVisit['VehicleVisit']['exits']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exit Id'); ?></dt>
		<dd>
			<?php echo h($vehicleVisit['VehicleVisit']['exit_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vehicle'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vehicleVisit['Vehicle']['description'], array('controller' => 'vehicles', 'action' => 'view', $vehicleVisit['Vehicle']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vehicle Visit'), array('action' => 'edit', $vehicleVisit['VehicleVisit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vehicle Visit'), array('action' => 'delete', $vehicleVisit['VehicleVisit']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicleVisit['VehicleVisit']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Visits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Visit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
	</ul>
</div>
