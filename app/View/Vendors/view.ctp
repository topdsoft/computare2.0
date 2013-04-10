<div class="vendors view">
<?php
// debug($vendor);  ?>
<h2><?php  echo __('Vendor: ').$vendor['VendorDetail']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vendor['Vendor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vendor['Vendor']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$vendor['Vendor']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($vendor['Vendor']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vendor'), array('action' => 'edit', $vendor['Vendor']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($vendor['Address'])): ?>
	<h3><?php echo __('Vendor Addresses'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Line 1'); ?></th>
		<th><?php echo __('Line 2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['Address'] as $address): ?>
		<tr>
			<td><?php echo $address['name']; ?></td>
			<td><?php echo $address['line1']; ?></td>
			<td><?php echo $address['line2']; ?></td>
			<td><?php echo $address['city']; ?></td>
			<td><?php echo $address['state']; ?></td>
			<td><?php echo $address['zip']; ?></td>
			<td><?php echo $address['created']; ?></td>
			<td><?php echo $users[$address['created_id']]; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($vendor['ItemCost'])): ?>
	<h3><?php echo __('Item Costs'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Remain'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['ItemCost'] as $itemCost): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$itemCost['item_id']],array('controller'=>'items','action'=>'view',$itemCost['item_id'])); ?></td>
			<td><?php echo $itemCost['cost']; ?></td>
			<td><?php echo $itemCost['qty']; ?></td>
			<td><?php echo $itemCost['remain']; ?></td>
			<td><?php echo $itemCost['created']; ?></td>
			<td><?php echo $users[$itemCost['created_id']]; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($vendor['PurchaseOrder'])): ?>
	<h3><?php echo __('Purchase Orders'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('AllowOpen'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['PurchaseOrder'] as $purchaseOrder): ?>
		<tr>
			<td><?php echo $this->Html->link($purchaseOrder['id'],array('controller'=>'purchaseOrders','action'=>'view',$purchaseOrder['id'])); ?></td>
			<td><?php echo $purchaseOrder['created']; ?></td>
			<td><?php echo $users[$purchaseOrder['created_id']]; ?></td>
			<td><?php echo $purchaseOrder['status']; ?></td>
			<td><?php if($purchaseOrder['allowOpen']) echo 'Y'; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'purchase_orders', 'action' => 'view', $purchaseOrder['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'purchase_orders', 'action' => 'edit', $purchaseOrder['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_orders', 'action' => 'delete', $purchaseOrder['id']), null, __('Are you sure you want to delete # %s?', $purchaseOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($vendor['Receipt'])): ?>
	<h3><?php echo __('Related Receipts'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Purchase Order'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['Receipt'] as $receipt): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$receipt['item_id']],array('controller'=>'items','action'=>'view',$receipt['item_id'])); ?></td>
			<td><?php echo $receipt['qty']; ?></td>
			<td><?php echo $receipt['created']; ?></td>
			<td><?php echo $users[$receipt['created_id']]; ?></td>
			<td><?php echo $this->Html->link($receipt['purchaseOrder_id'],array('controller'=>'purchaseOrders','action'=>'view',$receipt['purchaseOrder_id'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($vendor['Revision'])): ?>
	<h3><?php echo __('Revisions'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['Revision'] as $vendorDetail): ?>
		<tr>
			<td><?php echo $vendorDetail['created']; ?></td>
			<td><?php echo $users[$vendorDetail['created_id']]; ?></td>
			<td><?php echo $vendorDetail['name']; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'vendor_details', 'action' => 'view', $vendorDetail['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'vendor_details', 'action' => 'edit', $vendorDetail['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'vendor_details', 'action' => 'delete', $vendorDetail['id']), null, __('Are you sure you want to delete # %s?', $vendorDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($vendor['Item'])): ?>
	<h3><?php echo __('Related Items'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('ItemDetail Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Serialized'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['created']; ?></td>
			<td><?php echo $item['itemDetail_id']; ?></td>
			<td><?php echo $item['category_id']; ?></td>
			<td><?php echo $item['active']; ?></td>
			<td><?php echo $item['serialized']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
