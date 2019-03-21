<div class="vehicleNotes view">
<h2><?php echo __('Vehicle Note'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vehicleNote['VehicleNote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vehicle'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vehicleNote['Vehicle']['description'], array('controller' => 'vehicles', 'action' => 'view', $vehicleNote['Vehicle']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vehicleNote['VehicleNote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($vehicleNote['VehicleNote']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($vehicleNote['VehicleNote']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vehicle Note'), array('action' => 'edit', $vehicleNote['VehicleNote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vehicle Note'), array('action' => 'delete', $vehicleNote['VehicleNote']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicleNote['VehicleNote']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Notes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Note'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
	</ul>
</div>
