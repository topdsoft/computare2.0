<div class="inventoryLocks index">
	<h2><?php echo __('Inventory Locks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th><?php //echo $this->Paginator->sort('removed'); ?></th>
			<th><?php //echo $this->Paginator->sort('removed_id'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($inventoryLocks as $inventoryLock): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($inventoryLock['Location']['name'], array('controller' => 'locations', 'action' => 'view', $inventoryLock['Location']['id'])); ?>
		</td>
		<td><?php echo h($inventoryLock['InventoryLock']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$inventoryLock['InventoryLock']['created_id']]; ?>&nbsp;</td>
		<td><?php //echo h($inventoryLock['InventoryLock']['removed']); ?>&nbsp;</td>
		<td><?php //echo h($inventoryLock['InventoryLock']['removed_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inventoryLock['InventoryLock']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inventoryLock['InventoryLock']['id']), null, __('Are you sure you want to delete # %s?', $inventoryLock['InventoryLock']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
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
		<li><?php echo $this->Html->link(__('New Inventory Lock'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
