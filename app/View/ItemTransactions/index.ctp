<div class="itemTransactions index">
	<h2><?php echo __('Item Transactions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Item.name','Item'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sale_id'); ?></th>
			<th><?php echo $this->Paginator->sort('receipt_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($itemTransactions as $itemTransaction): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($itemTransaction['Item']['name'], array('controller' => 'items', 'action' => 'view', $itemTransaction['Item']['id'])); ?>
		</td>
		<td><?php echo h($itemTransaction['ItemTransaction']['qty']); ?>&nbsp;</td>
		<td><?php echo h($itemTransaction['ItemTransaction']['type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemTransaction['Location']['name'], array('controller' => 'locations', 'action' => 'view', $itemTransaction['Location']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($itemTransaction['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $itemTransaction['Sale']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($itemTransaction['Receipt']['id'], array('controller' => 'receipts', 'action' => 'view', $itemTransaction['Receipt']['id'])); ?>
		</td>
		<td><?php echo h($itemTransaction['ItemTransaction']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$itemTransaction['ItemTransaction']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemTransaction['ItemTransaction']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
	</ul>
</div>
