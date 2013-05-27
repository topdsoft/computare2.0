<div class="invoices form">
<?php echo $this->Form->create('Invoice'); ?>
	<fieldset>
		<legend><?php echo __('Make Payment on Invoice: '),$this->data['Invoice']['id']; ?></legend>
	<dl>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$invoice['Invoice']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($invoice['Invoice']['closed']): ?>
			<dt><?php echo __('Closed'); ?></dt>
			<dd>
				<?php echo h($invoice['Invoice']['closed']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Closed By'); ?></dt>
			<dd>
				<?php echo $users[$invoice['Invoice']['closed_id']]; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($invoice['Customer']['name']): ?>
			<dt><?php echo __('Customer'); ?></dt>
			<dd>
				<?php echo $this->Html->link($invoice['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $invoice['Customer']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sales Order'); ?></dt>
			<dd>
				<?php echo $this->Html->link($invoice['SalesOrder']['id'], array('controller' => 'sales_orders', 'action' => 'view', $invoice['SalesOrder']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($invoice['Vendor']['name']): ?>
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
			<dt><?php echo __('Vendor Invoice Id'); ?></dt>
			<dd>
				<?php echo $invoice['Invoice']['number']; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
	</dl>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('payment',array('id'=>'sc'));
		echo $this->Form->input('interest',array('label'=>'Interest (optional)'));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
</div>
<div class="related">
	<?php if (!empty($invoice['InvoiceDetail'])): ?>
	<h3>Invoice History</h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($invoice['InvoiceDetail'] as $invoiceDetail): ?>
		<tr>
			<td><?php echo $invoiceDetail['text']; ?></td>
			<td><?php echo $invoiceDetail['amount']; ?></td>
			<td><?php echo $invoiceDetail['created']; ?></td>
			<td><?php echo $users[$invoiceDetail['created_id']]; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<?php
// debug($this->data);?>

</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>