<div class="vehicleVisits index">
	<h2><?php echo __('Vehicle Visits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('exits'); ?></th>
			<th><?php echo $this->Paginator->sort('exit_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vehicle_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($vehicleVisits as $vehicleVisit): ?>
	<tr>
		<td><?php echo h($vehicleVisit['VehicleVisit']['id']); ?>&nbsp;</td>
		<td><?php echo h($vehicleVisit['VehicleVisit']['created']); ?>&nbsp;</td>
		<td><?php echo h($vehicleVisit['VehicleVisit']['created_id']); ?>&nbsp;</td>
		<td><?php echo h($vehicleVisit['VehicleVisit']['exits']); ?>&nbsp;</td>
		<td><?php echo h($vehicleVisit['VehicleVisit']['exit_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vehicleVisit['Vehicle']['description'], array('controller' => 'vehicles', 'action' => 'view', $vehicleVisit['Vehicle']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $vehicleVisit['VehicleVisit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vehicleVisit['VehicleVisit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vehicleVisit['VehicleVisit']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicleVisit['VehicleVisit']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Vehicle Visit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
	</ul>
</div>
