<div class="sales index">
	<h2><?php echo __('Sales'); ?></h2>
	<?php echo $this->element('reportdetails'); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('salesOrderDetail.qty','Qty'); ?></th>
			<th><?php echo $this->Paginator->sort('salesOrderDetail.price','Price'); ?></th>
			<th><?php echo $this->Paginator->sort('salesOrderDetail.salesOrder_id','Sales Order'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($sales as $sale): ?>
	<tr>
		<td><?php echo h($sale['Sale']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$sale['Sale']['created_id']]; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sale['Item']['name'], array('controller' => 'items', 'action' => 'view', $sale['Item']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($sale['Service']['name'], array('controller' => 'services', 'action' => 'view', $sale['Service']['id'])); ?>
		</td>
		<td><?php echo $sale['SalesOrderDetail']['qty']; ?></td>
		<td><?php echo $sale['SalesOrderDetail']['price']; ?></td>
		<td>
			<?php echo $this->Html->link($sale['SalesOrderDetail']['salesOrder_id'], array('controller' => 'sales_orders', 'action' => 'view', $sale['SalesOrderDetail']['salesOrder_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($sale['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $sale['Customer']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sales Order'), array('controller'=>'salesOrders','action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
