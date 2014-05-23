<div class="purchaseOrders index">
<?php echo $this->Form->create('PurchaseOrder') ?>
	<h2><?php echo __('Purchase Orders'); ?></h2>
	<?php echo $this->element('filterblock'); ?>
	<?php echo $this->element('reportdetails'); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('lines'); ?></th>
			<th><?php echo $this->Paginator->sort('rec','Qty Rec'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($purchaseOrders as $purchaseOrder): ?>
	<tr>
		<td><?php echo h($purchaseOrder['PurchaseOrder']['id']); ?>&nbsp;</td>
		<td><?php echo h($purchaseOrder['PurchaseOrder']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$purchaseOrder['PurchaseOrder']['created_id']]; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($purchaseOrder['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $purchaseOrder['Vendor']['id'])); ?>
		</td>
		<td><?php echo h($purchaseOrder['PurchaseOrder']['status']); ?>&nbsp;</td>
		<td><?php echo h($purchaseOrder['PurchaseOrder']['lines']); ?>&nbsp;</td>
		<td><?php echo h($purchaseOrder['PurchaseOrder']['rec']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $purchaseOrder['PurchaseOrder']['id'])); ?>
			<?php if($purchaseOrder['PurchaseOrder']['status']=='O') echo $this->Html->link(__('Edit'), array('action' => 'edit', $purchaseOrder['PurchaseOrder']['id'])); ?>
			<?php if($purchaseOrder['PurchaseOrder']['status']=='O' && $purchaseOrder['PurchaseOrder']['lines']>0) echo $this->Html->link(__('Receive'), array('action' => 'receive', $purchaseOrder['PurchaseOrder']['id'])); ?>
			<?php if($purchaseOrder['PurchaseOrder']['rec']>0 && $purchaseOrder['PurchaseOrder']['status']=='O') echo $this->Html->link(__('Close'), array('action' => 'close', $purchaseOrder['PurchaseOrder']['id'])); ?>
			<?php if($purchaseOrder['PurchaseOrder']['rec']==0 && $purchaseOrder['PurchaseOrder']['status']=='O') echo $this->Html->link(__('Void'), array('action' => 'void', $purchaseOrder['PurchaseOrder']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $purchaseOrder['PurchaseOrder']['id']), null, __('Are you sure you want to delete # %s?', $purchaseOrder['PurchaseOrder']['id'])); ?>
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
<?php echo $this->element('actionsblock'); ?>
