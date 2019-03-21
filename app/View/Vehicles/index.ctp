<div class="vehicles index">
	<h2><?php echo __('Vehicles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
<<<<<<< HEAD
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th></th>
=======
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vin'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
>>>>>>> 44d296b63133d3d505eb6f2f10a5717a5030ee88
	</tr>
	</thead>
	<tbody>
	<?php foreach ($vehicles as $vehicle): ?>
	<tr>
		<td><?php echo h($vehicle['Vehicle']['id']); ?>&nbsp;</td>
<<<<<<< HEAD
		<td>
			<?php echo $this->Html->link($vehicle['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $vehicle['Customer']['id'])); ?>
		</td>
=======
		<td><?php echo h($vehicle['Vehicle']['created']); ?>&nbsp;</td>
		<td><?php echo h($vehicle['Vehicle']['created_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vehicle['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $vehicle['Customer']['id'])); ?>
		</td>
		<td><?php echo h($vehicle['Vehicle']['vin']); ?>&nbsp;</td>
>>>>>>> 44d296b63133d3d505eb6f2f10a5717a5030ee88
		<td><?php echo h($vehicle['Vehicle']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $vehicle['Vehicle']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vehicle['Vehicle']['id'])); ?>
<<<<<<< HEAD
=======
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vehicle['Vehicle']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicle['Vehicle']['id']))); ?>
>>>>>>> 44d296b63133d3d505eb6f2f10a5717a5030ee88
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
		<li><?php echo $this->Html->link(__('New Vehicle'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
<<<<<<< HEAD
		<li><?php echo $this->Html->link(__('List Vehicle Visits'), array('controller' => 'vehicle_visits', 'action' => 'index')); ?> </li>
=======
		<li><?php echo $this->Html->link(__('List Vehicle Notes'), array('controller' => 'vehicle_notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Note'), array('controller' => 'vehicle_notes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Visits'), array('controller' => 'vehicle_visits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Visit'), array('controller' => 'vehicle_visits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
>>>>>>> 44d296b63133d3d505eb6f2f10a5717a5030ee88
	</ul>
</div>
