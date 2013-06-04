<div class="inventoryCounts index">
	<h2><?php echo __('Inventory Counts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th><?php echo $this->Paginator->sort('finished'); ?></th>
			<th><?php //echo $this->Paginator->sort('notes'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($inventoryCounts as $inventoryCount): ?>
	<tr>
		<td><?php echo h($inventoryCount['InventoryCount']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$inventoryCount['InventoryCount']['created_id']]; ?>&nbsp;</td>
		<td><?php echo h($inventoryCount['InventoryCount']['finished']); ?>&nbsp;</td>
		<td><?php //echo h($inventoryCount['InventoryCount']['notes']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inventoryCount['InventoryCount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inventoryCount['InventoryCount']['id'])); ?>
			<?php echo $this->Html->link(__('Count'), array('action' => 'count', $inventoryCount['InventoryCount']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Inventory Count'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
	</ul>
</div>
