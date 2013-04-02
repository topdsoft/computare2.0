<div class="purchaseOrders view">
<h2><?php  echo __('Purchase Order: ').$purchaseOrder['PurchaseOrder']['id']; ?></h2>
	<dl>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($purchaseOrder['PurchaseOrder']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$purchaseOrder['PurchaseOrder']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($purchaseOrder['PurchaseOrder']['voided_id']): ?>
			<dt><?php echo __('Voided'); ?></dt>
			<dd>
				<?php echo h($purchaseOrder['PurchaseOrder']['voided']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Voided By'); ?></dt>
			<dd>
				<?php echo $users[$purchaseOrder['PurchaseOrder']['voided_id']]; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($purchaseOrder['PurchaseOrder']['closed_id']): ?>
			<dt><?php echo __('Closed'); ?></dt>
			<dd>
				<?php echo h($purchaseOrder['PurchaseOrder']['closed']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Closed By'); ?></dt>
			<dd>
				<?php echo $users[$purchaseOrder['PurchaseOrder']['closed_id']]; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('Vendor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($purchaseOrder['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $purchaseOrder['Vendor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($purchaseOrder['PurchaseOrder']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AllowOpen'); ?></dt>
		<dd>
			<?php echo h($purchaseOrder['PurchaseOrder']['allowOpen']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //debug($purchaseOrder); ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if($purchaseOrder['PurchaseOrder']['status']=='O') echo $this->Html->link(__('Edit Purchase Order'), array('action' => 'edit', $purchaseOrder['PurchaseOrder']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($purchaseOrder['PurchaseOrderDetail'])): ?>
	<h3><?php echo __('Purchase Order Details'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Rec'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;//debug($purchaseOrder['PurchaseOrderDetail']);
		foreach ($purchaseOrder['PurchaseOrderDetail'] as $purchaseOrderDetail): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$purchaseOrderDetail['item_id']],array('controller'=>'items','action'=>'view',$purchaseOrderDetail['item_id'])) ; ?></td>
			<td><?php echo $purchaseOrderDetail['qty']; ?></td>
			<td><?php echo $purchaseOrderDetail['rec']; ?></td>
			<td><?php echo $purchaseOrderDetail['cost']; ?></td>
			<td><?php echo $purchaseOrderDetail['created']; ?></td>
			<td><?php echo $users[$purchaseOrderDetail['created_id']]; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'purchase_order_details', 'action' => 'view', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'purchase_order_details', 'action' => 'edit', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_order_details', 'action' => 'delete', $purchaseOrderDetail['id']), null, __('Are you sure you want to delete # %s?', $purchaseOrderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($purchaseOrder['RemovedLine'])): ?>
	<h3><?php echo __('Removed Lines'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Rec'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('Removed'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;//debug($purchaseOrder['PurchaseOrderDetail']);
		foreach ($purchaseOrder['RemovedLine'] as $purchaseOrderDetail): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$purchaseOrderDetail['item_id']],array('controller'=>'items','action'=>'view',$purchaseOrderDetail['item_id'])) ; ?></td>
			<td><?php echo $purchaseOrderDetail['qty']; ?></td>
			<td><?php echo $purchaseOrderDetail['rec']; ?></td>
			<td><?php echo $purchaseOrderDetail['cost']; ?></td>
			<td><?php echo $purchaseOrderDetail['removed']; ?></td>
			<td><?php echo $users[$purchaseOrderDetail['removed_id']]; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'purchase_order_details', 'action' => 'view', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'purchase_order_details', 'action' => 'edit', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_order_details', 'action' => 'delete', $purchaseOrderDetail['id']), null, __('Are you sure you want to delete # %s?', $purchaseOrderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
