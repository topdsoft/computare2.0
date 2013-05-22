<div class="invoices view">
<h2><?php  echo __('Invoice'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Closed'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['closed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Closed Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['closed_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invoice['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $invoice['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invoice['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $invoice['Vendor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invoice['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $invoice['PurchaseOrder']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sales Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invoice['SalesOrder']['id'], array('controller' => 'sales_orders', 'action' => 'view', $invoice['SalesOrder']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Invoice'), array('action' => 'edit', $invoice['Invoice']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Invoice'), array('action' => 'delete', $invoice['Invoice']['id']), null, __('Are you sure you want to delete # %s?', $invoice['Invoice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Invoice Details'); ?></h3>
	<?php if (!empty($invoice['InvoiceDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Invoice Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Removed'); ?></th>
		<th><?php echo __('Removed Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($invoice['InvoiceDetail'] as $invoiceDetail): ?>
		<tr>
			<td><?php echo $invoiceDetail['id']; ?></td>
			<td><?php echo $invoiceDetail['invoice_id']; ?></td>
			<td><?php echo $invoiceDetail['created']; ?></td>
			<td><?php echo $invoiceDetail['created_id']; ?></td>
			<td><?php echo $invoiceDetail['removed']; ?></td>
			<td><?php echo $invoiceDetail['removed_id']; ?></td>
			<td><?php echo $invoiceDetail['active']; ?></td>
			<td><?php echo $invoiceDetail['text']; ?></td>
			<td><?php echo $invoiceDetail['amount']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invoice_details', 'action' => 'view', $invoiceDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invoice_details', 'action' => 'edit', $invoiceDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invoice_details', 'action' => 'delete', $invoiceDetail['id']), null, __('Are you sure you want to delete # %s?', $invoiceDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invoice Detail'), array('controller' => 'invoice_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
