<div class="invoices index">
	<h2><?php echo __('Invoices'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('closed'); ?></th>
			<th><?php echo $this->Paginator->sort('closed_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_id'); ?></th>
			<th><?php echo $this->Paginator->sort('purchaseOrder_id'); ?></th>
			<th><?php echo $this->Paginator->sort('salesOrder_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($invoices as $invoice): ?>
	<tr>
		<td><?php echo h($invoice['Invoice']['id']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['created']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['created_id']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['closed']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['closed_id']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($invoice['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $invoice['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($invoice['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $invoice['Vendor']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($invoice['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $invoice['PurchaseOrder']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($invoice['SalesOrder']['id'], array('controller' => 'sales_orders', 'action' => 'view', $invoice['SalesOrder']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $invoice['Invoice']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $invoice['Invoice']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $invoice['Invoice']['id']), null, __('Are you sure you want to delete # %s?', $invoice['Invoice']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Invoice'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vendors'), array('controller' => 'vendors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vendor'), array('controller' => 'vendors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Orders'), array('controller' => 'sales_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Order'), array('controller' => 'sales_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoice Details'), array('controller' => 'invoice_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice Detail'), array('controller' => 'invoice_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
