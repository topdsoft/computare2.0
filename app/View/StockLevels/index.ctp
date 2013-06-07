<div class="stockLevels index">
	<h2><?php echo __('Stock Levels'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('priority'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($stockLevels as $stockLevel): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($stockLevel['Location']['name'], array('controller' => 'locations', 'action' => 'view', $stockLevel['Location']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($stockLevel['Item']['name'], array('controller' => 'items', 'action' => 'view', $stockLevel['Item']['id'])); ?>
		</td>
		<td><?php echo h($stockLevel['StockLevel']['qty']); ?>&nbsp;</td>
		<td><?php echo h($stockLevel['StockLevel']['priority']); ?>&nbsp;</td>
		<td><?php echo h($stockLevel['StockLevel']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$stockLevel['StockLevel']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $stockLevel['StockLevel']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stockLevel['StockLevel']['item_id'],$stockLevel['StockLevel']['location_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Stock Level'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
