<div class="items view">
<h2><?php  echo __('Item: ').$item['Item']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($item['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($item['Item']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($item['Item']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Serialized'); ?></dt>
		<dd>
			<?php echo h($item['Item']['serialized']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SKU'); ?></dt>
		<dd>
			<?php echo h($item['ItemDetail']['sku']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UPC'); ?></dt>
		<dd>
			<?php echo h($item['ItemDetail']['upc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($item['ItemCategory']['name'],array('controller'=>'itemCategories','action'=>'view',$item['ItemCategory']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php 
// debug($item) ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item'), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Receive Item'), array('action' => 'receive', $item['Item']['id'])); ?> </li>
	</ul>
</div>

<div class="related">
	<?php if (!empty($item['ItemGroup'])): ?>
	<h3><?php echo __('Item in Groups'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['ItemGroup'] as $itemGroup): ?>
		<tr>
			<td><?php echo $this->Html->link($itemGroup['name'],array('controller'=>'itemGroups','action'=>'view',$itemGroup['id'])) ; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_groups', 'action' => 'view', $itemGroup['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_groups', 'action' => 'edit', $itemGroup['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_groups', 'action' => 'delete', $itemGroup['id']), null, __('Are you sure you want to delete # %s?', $itemGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['Image'])): ?>
	<h3><?php echo __('Related Images'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Image'] as $image): ?>
		<tr>
			<td><?php echo $image['id']; ?></td>
			<td><?php echo $image['created']; ?></td>
			<td><?php echo $image['created_id']; ?></td>
			<td><?php echo $image['filename']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'images', 'action' => 'delete', $image['id']), null, __('Are you sure you want to delete # %s?', $image['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<?php if (!empty($item['Location'])): ?>
	<h3><?php echo __('Item is at these Locations'); ?></h3>
<?php //debug($item['Location']);?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Location'] as $location): ?>
		<tr>
			<td><?php echo $this->Html->link($location['name'], array('controller' => 'locations', 'action' => 'view', $location['id'])) ; ?></td>
			<td><?php echo $location['ItemsLocation']['qty']; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'locations', 'action' => 'view', $location['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'locations', 'action' => 'edit', $location['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'locations', 'action' => 'delete', $location['id']), null, __('Are you sure you want to delete # %s?', $location['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['ItemCost'])): ?>
	<h3><?php echo __('Item Costs'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Vendor'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;//debug($item['ItemCost']);
		foreach ($item['ItemCost'] as $itemCost): ?>
		<tr>
			<td><?php echo $itemCost['created']; ?></td>
			<td><?php echo $itemCost['qty']; ?></td>
			<td><?php echo $itemCost['cost']; ?></td>
			<td><?php echo $users[$itemCost['created_id']]; ?></td>
			<td><?php echo $this->Html->link($vendors[$itemCost['vendor_id']],array('controller'=>'vendors','action'=>'view',$itemCost['vendor_id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_costs', 'action' => 'view', $itemCost['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_costs', 'action' => 'edit', $itemCost['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_costs', 'action' => 'delete', $itemCost['id']), null, __('Are you sure you want to delete # %s?', $itemCost['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['Revisions'])): ?>
	<h3><?php echo __('Revisions'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Upc'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;//debug($item['Revisions']);
		foreach ($item['Revisions'] as $itemDetail): ?>
		<tr>
			<td><?php echo $itemDetail['created']; ?></td>
			<td><?php echo $users[$itemDetail['created_id']]; ?></td>
			<td><?php echo $itemDetail['name']; ?></td>
			<td><?php echo $itemDetail['sku']; ?></td>
			<td><?php echo $itemDetail['upc']; ?></td>
			<td><?php echo $this->Html->link($categories[$itemDetail['category_id']],array('controller'=>'itemCategories','action'=>'view',$itemDetail['category_id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_details', 'action' => 'view', $itemDetail['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_details', 'action' => 'edit', $itemDetail['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_details', 'action' => 'delete', $itemDetail['id']), null, __('Are you sure you want to delete # %s?', $itemDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<?php if (!empty($item['ItemSerialNumber'])): ?>
	<h3><?php echo __('Item Serial Numbers'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Number'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Item Location'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;//debug($itemlocations);//debug($item['ItemSerialNumber']);
		foreach ($item['ItemSerialNumber'] as $itemSerialNumber): ?>
		<tr>
			<td><?php echo $itemSerialNumber['number']; ?></td>
			<td><?php echo $itemSerialNumber['created']; ?></td>
			<td><?php echo $users[$itemSerialNumber['created_id']]; ?></td>
			<td><?php if($itemSerialNumber['item_location_id']) echo $this->Html->link($locations[$itemlocations[$itemSerialNumber['item_location_id']]],array('controller'=>'locations','action'=>'view',$itemlocations[$itemSerialNumber['item_location_id']])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_serial_numbers', 'action' => 'view', $itemSerialNumber['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_serial_numbers', 'action' => 'edit', $itemSerialNumber['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_serial_numbers', 'action' => 'delete', $itemSerialNumber['id']), null, __('Are you sure you want to delete # %s?', $itemSerialNumber['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Item Serial Number'), array('controller' => 'item_serial_numbers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<?php if (!empty($item['ItemTransaction'])): ?>
	<h3><?php echo __('Item Transactions'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
// debug($item['ItemTransaction']);
		foreach ($item['ItemTransaction'] as $itemTransaction): ?>
		<tr>
			<td><?php echo $itemTransaction['created']; ?></td>
			<td><?php echo $users[$itemTransaction['created_id']]; ?></td>
			<td><?php echo $itemTransaction['type']; ?></td>
			<td><?php echo $itemTransaction['qty']; ?></td>
			<td><?php echo $this->Html->link($locations[$itemTransaction['location_id']], array('controller'=>'locations','action'=>'view',$itemTransaction['location_id'])); ; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_transactions', 'action' => 'view', $itemTransaction['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_transactions', 'action' => 'edit', $itemTransaction['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_transactions', 'action' => 'delete', $itemTransaction['id']), null, __('Are you sure you want to delete # %s?', $itemTransaction['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['PurchaseOrderDetail'])): ?>
	<h3><?php echo __('Purchase Order Details'); ?></h3>
<?php // debug($item['PurchaseOrderDetail']); ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Purchase Order'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Rec'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['PurchaseOrderDetail'] as $purchaseOrderDetail): ?>
		<tr>
			<td><?php echo $this->Html->link($purchaseOrderDetail['purchaseOrder_id'],array('controller'=>'purchaseOrders','action'=>'view',$purchaseOrderDetail['purchaseOrder_id'])); ?></td>
			<td><?php echo $purchaseOrderDetail['created']; ?></td>
			<td><?php echo $users[$purchaseOrderDetail['created_id']]; ?></td>
			<td><?php echo $purchaseOrderDetail['qty']; ?></td>
			<td><?php echo $purchaseOrderDetail['rec']; ?></td>
			<td><?php echo $purchaseOrderDetail['cost']; ?></td>
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
	<?php if (!empty($item['Receipt'])): ?>
	<h3><?php echo __('Item Receipts'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Purchase Order'); ?></th>
		<th><?php echo __('Vendor'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Receipt'] as $receipt): ?>
		<tr>
			<td><?php echo $receipt['created']; ?></td>
			<td><?php echo $users[$receipt['created_id']]; ?></td>
			<td><?php echo $receipt['qty']; ?></td>
			<td><?php echo $this->Html->link($receipt['purchaseOrder_id'],array('controller'=>'purchaseOrders','action'=>'view',$receipt['purchaseOrder_id'])); ?></td>
			<td><?php echo $this->Html->link($vendors[$receipt['vendor_id']],array('controller'=>'vendors','action'=>'view',$receipt['vendor_id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'receipts', 'action' => 'view', $receipt['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'receipts', 'action' => 'edit', $receipt['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'receipts', 'action' => 'delete', $receipt['id']), null, __('Are you sure you want to delete # %s?', $receipt['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['Sale'])): ?>
	<h3><?php echo __('Related Sales'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('SalesOrder Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Sale'] as $sale): ?>
		<tr>
			<td><?php echo $sale['id']; ?></td>
			<td><?php echo $sale['created']; ?></td>
			<td><?php echo $sale['created_id']; ?></td>
			<td><?php echo $sale['item_id']; ?></td>
			<td><?php echo $sale['salesOrder_id']; ?></td>
			<td><?php echo $sale['customer_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sales', 'action' => 'view', $sale['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sales', 'action' => 'edit', $sale['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sales', 'action' => 'delete', $sale['id']), null, __('Are you sure you want to delete # %s?', $sale['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['SalesOrderDetail'])): ?>
	<h3><?php echo __('Related Sales Order Details'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('PurchaseOrder Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Rec'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['SalesOrderDetail'] as $salesOrderDetail): ?>
		<tr>
			<td><?php echo $salesOrderDetail['id']; ?></td>
			<td><?php echo $salesOrderDetail['created']; ?></td>
			<td><?php echo $salesOrderDetail['created_id']; ?></td>
			<td><?php echo $salesOrderDetail['purchaseOrder_id']; ?></td>
			<td><?php echo $salesOrderDetail['item_id']; ?></td>
			<td><?php echo $salesOrderDetail['qty']; ?></td>
			<td><?php echo $salesOrderDetail['rec']; ?></td>
			<td><?php echo $salesOrderDetail['cost']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sales_order_details', 'action' => 'view', $salesOrderDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sales_order_details', 'action' => 'edit', $salesOrderDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sales_order_details', 'action' => 'delete', $salesOrderDetail['id']), null, __('Are you sure you want to delete # %s?', $salesOrderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['Customer'])): ?>
	<h3><?php echo __('Related Customers'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('CustomerDetail Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Deleted Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Customer'] as $customer): ?>
		<tr>
			<td><?php echo $customer['id']; ?></td>
			<td><?php echo $customer['customerDetail_id']; ?></td>
			<td><?php echo $customer['active']; ?></td>
			<td><?php echo $customer['created']; ?></td>
			<td><?php echo $customer['created_id']; ?></td>
			<td><?php echo $customer['modified']; ?></td>
			<td><?php echo $customer['deleted_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'customers', 'action' => 'view', $customer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'customers', 'action' => 'edit', $customer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'customers', 'action' => 'delete', $customer['id']), null, __('Are you sure you want to delete # %s?', $customer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($item['Vendor'])): ?>
	<h3><?php echo __('Related Vendors'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Vendor'] as $vendor): ?>
		<tr>
			<td><?php echo $vendor['id']; ?></td>
			<td><?php echo $vendor['created']; ?></td>
			<td><?php echo $vendor['created_id']; ?></td>
			<td><?php echo $vendor['active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vendors', 'action' => 'view', $vendor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vendors', 'action' => 'edit', $vendor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vendors', 'action' => 'delete', $vendor['id']), null, __('Are you sure you want to delete # %s?', $vendor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<?php echo $this->Html->script('sliderelated.js') ?>