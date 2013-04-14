<div class="salesOrders index">
	<h2><?php echo __('Sales Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('closed'); ?></th>
			<th><?php echo $this->Paginator->sort('closed_id'); ?></th>
			<th><?php echo $this->Paginator->sort('voided'); ?></th>
			<th><?php echo $this->Paginator->sort('voided_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('SalesOrderType_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($salesOrders as $salesOrder): ?>
	<tr>
		<td><?php echo h($salesOrder['SalesOrder']['id']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['created']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['created_id']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['closed']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['closed_id']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['voided']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['voided_id']); ?>&nbsp;</td>
		<td><?php echo h($salesOrder['SalesOrder']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($salesOrder['SalesOrderType']['name'], array('controller' => 'sales_order_types', 'action' => 'view', $salesOrder['SalesOrderType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($salesOrder['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $salesOrder['Customer']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $salesOrder['SalesOrder']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $salesOrder['SalesOrder']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $salesOrder['SalesOrder']['id']), null, __('Are you sure you want to delete # %s?', $salesOrder['SalesOrder']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sales Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales Order Types'), array('controller' => 'sales_order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Order Type'), array('controller' => 'sales_order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
