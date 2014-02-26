<div class="sales view">
<h2><?php  echo __('Sale'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo $users[$sale['Sale']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($sale['Item']['id']): ?>
			<dt><?php echo __('Item'); ?></dt>
			<dd>
				<?php echo $this->Html->link($sale['Item']['name'], array('controller' => 'items', 'action' => 'view', $sale['Item']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($sale['Service']['id']): ?>
			<dt><?php echo __('Service'); ?></dt>
			<dd>
				<?php echo $this->Html->link($sale['Service']['name'], array('controller' => 'services', 'action' => 'view', $sale['Service']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('Sales Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sale['SalesOrderDetail']['salesOrder_id'], array('controller' => 'sales_orders', 'action' => 'view', $sale['SalesOrderDetail']['salesOrder_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sale['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $sale['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd><?php echo $sale['SalesOrderDetail']['qty']; ?></dt>
		<dt><?php echo __('Shipped'); ?></dt>
		<dd><?php echo $sale['SalesOrderDetail']['shipped']; ?></dt>
		<dt><?php echo __('Price'); ?></dt>
		<dd><?php echo $sale['SalesOrderDetail']['price']; ?></dt>
		<dt><?php echo __('Tax'); ?></dt>
		<dd><?php echo $sale['SalesOrderDetail']['tax']; ?></dt>
	</dl>
</div>
<?php echo $this->element('reportdetails'); ?>
<div class="related">
	<?php if (!empty($sale['ItemTransaction'])): ?>
	<h3><?php echo __('Related Item Transactions'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Sale Id'); ?></th>
		<th><?php echo __('Receipt Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sale['ItemTransaction'] as $itemTransaction): ?>
		<tr>
			<td><?php echo $itemTransaction['id']; ?></td>
			<td><?php echo $itemTransaction['created']; ?></td>
			<td><?php echo $itemTransaction['created_id']; ?></td>
			<td><?php echo $itemTransaction['item_id']; ?></td>
			<td><?php echo $itemTransaction['location_id']; ?></td>
			<td><?php echo $itemTransaction['sale_id']; ?></td>
			<td><?php echo $itemTransaction['receipt_id']; ?></td>
			<td><?php echo $itemTransaction['qty']; ?></td>
			<td><?php echo $itemTransaction['type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'item_transactions', 'action' => 'view', $itemTransaction['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'item_transactions', 'action' => 'edit', $itemTransaction['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'item_transactions', 'action' => 'delete', $itemTransaction['id']), null, __('Are you sure you want to delete # %s?', $itemTransaction['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
