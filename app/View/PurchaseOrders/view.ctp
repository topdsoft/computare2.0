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
		<dt><?php echo __('Allow Open'); ?></dt>
		<dd>
			<?php if($purchaseOrder['PurchaseOrder']['allowOpen']) echo 'YES'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('On Account'); ?></dt>
		<dd>
			<?php if($purchaseOrder['PurchaseOrder']['onAccount']) echo 'YES'; ?>
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
	</tr>
	<?php
		$i = 0;
		$totalCost=0;
		$totalRec=0;
		$totalQty=0;//debug($purchaseOrder['PurchaseOrderDetail']);
		foreach ($purchaseOrder['PurchaseOrderDetail'] as $purchaseOrderDetail): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$purchaseOrderDetail['item_id']],array('controller'=>'items','action'=>'view',$purchaseOrderDetail['item_id'])) ; ?></td>
			<td><?php echo $purchaseOrderDetail['qty']; $totalQty+=$purchaseOrderDetail['qty']; ?></td>
			<td><?php echo $purchaseOrderDetail['rec']; $totalRec+=$purchaseOrderDetail['rec']; ?></td>
			<td><?php echo $purchaseOrderDetail['cost']; $totalCost+=$purchaseOrderDetail['cost']*$purchaseOrderDetail['rec']; ?></td>
			<td><?php echo $purchaseOrderDetail['created']; ?></td>
			<td><?php echo $users[$purchaseOrderDetail['created_id']]; ?></td>
		</tr>
	<?php endforeach; ?>
	<?php
		echo '<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>';
		echo '<tr>';
		echo "<td>Sub Total</td><td>$totalQty</td><td>$totalRec</td><td>".number_format($totalCost,2)."</td><td></td><td></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>Tax</td><td></td><td></td><td>'.$purchaseOrder['PurchaseOrder']['tax'].'</td><td></td><td></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Shipping</td><td></td><td></td><td>'.$purchaseOrder['PurchaseOrder']['shipping'].'</td><td></td><td></td>';
		echo '</tr>';
		echo '<tr>';
		echo "<th>Total</th><th>$totalQty</th><th>$totalRec</th><th>".number_format($totalCost+$purchaseOrder['PurchaseOrder']['tax']+$purchaseOrder['PurchaseOrder']['shipping'],2)."</th><th></th><th></th>";
		echo '</tr>';
	?>
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
