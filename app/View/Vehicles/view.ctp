<div class="vehicles view">
<h2><?php echo __('Vehicle'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vehicle['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $vehicle['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vin'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['vin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vehicle'), array('action' => 'edit', $vehicle['Vehicle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vehicle'), array('action' => 'delete', $vehicle['Vehicle']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicle['Vehicle']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Notes'), array('controller' => 'vehicle_notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Note'), array('controller' => 'vehicle_notes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Visits'), array('controller' => 'vehicle_visits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Visit'), array('controller' => 'vehicle_visits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Vehicle Notes'); ?></h3>
	<?php if (!empty($vehicle['VehicleNote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Vehicle Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicle['VehicleNote'] as $vehicleNote): ?>
		<tr>
			<td><?php echo $vehicleNote['id']; ?></td>
			<td><?php echo $vehicleNote['vehicle_id']; ?></td>
			<td><?php echo $vehicleNote['created']; ?></td>
			<td><?php echo $vehicleNote['created_id']; ?></td>
			<td><?php echo $vehicleNote['note']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vehicle_notes', 'action' => 'view', $vehicleNote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vehicle_notes', 'action' => 'edit', $vehicleNote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vehicle_notes', 'action' => 'delete', $vehicleNote['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicleNote['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vehicle Note'), array('controller' => 'vehicle_notes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Vehicle Visits'); ?></h3>
	<?php if (!empty($vehicle['VehicleVisit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Exits'); ?></th>
		<th><?php echo __('Exit Id'); ?></th>
		<th><?php echo __('Vehicle Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicle['VehicleVisit'] as $vehicleVisit): ?>
		<tr>
			<td><?php echo $vehicleVisit['id']; ?></td>
			<td><?php echo $vehicleVisit['created']; ?></td>
			<td><?php echo $vehicleVisit['created_id']; ?></td>
			<td><?php echo $vehicleVisit['exits']; ?></td>
			<td><?php echo $vehicleVisit['exit_id']; ?></td>
			<td><?php echo $vehicleVisit['vehicle_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vehicle_visits', 'action' => 'view', $vehicleVisit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vehicle_visits', 'action' => 'edit', $vehicleVisit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vehicle_visits', 'action' => 'delete', $vehicleVisit['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicleVisit['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vehicle Visit'), array('controller' => 'vehicle_visits', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Images'); ?></h3>
	<?php if (!empty($vehicle['Image'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th><?php echo __('Thumbnail'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicle['Image'] as $image): ?>
		<tr>
			<td><?php echo $image['id']; ?></td>
			<td><?php echo $image['created']; ?></td>
			<td><?php echo $image['created_id']; ?></td>
			<td><?php echo $image['filename']; ?></td>
			<td><?php echo $image['thumbnail']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'images', 'action' => 'delete', $image['id']), array('confirm' => __('Are you sure you want to delete # %s?', $image['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
