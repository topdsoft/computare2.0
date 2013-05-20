<div class="purchaseOrders form">
<?php echo $this->Form->create('PurchaseOrder'); ?>
	<fieldset>
		<legend><?php echo __('Edit Purchase Order: '),$this->data['PurchaseOrder']['id']; ?></legend>
	<?php
// debug($this->data);
		echo $this->Form->input('id');
		echo 'Vendor: '.$this->Html->link($this->data['Vendor']['name'],array('controller'=>'vendors','action'=>'view',$this->data['Vendor']['id']));
	?><br><br>

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
		foreach ($this->data['PurchaseOrderDetail'] as $purchaseOrderDetail): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$purchaseOrderDetail['item_id']],array('controller'=>'items','action'=>'view',$purchaseOrderDetail['item_id'])) ; ?></td>
			<td><?php echo $purchaseOrderDetail['qty']; ?></td>
			<td><?php echo $purchaseOrderDetail['rec']; ?></td>
			<td><?php echo $purchaseOrderDetail['cost']; ?></td>
			<td><?php echo $purchaseOrderDetail['created']; ?></td>
			<td><?php echo $users[$purchaseOrderDetail['created_id']]; ?></td>
			<td class="actions">
				<?php if($purchaseOrderDetail['rec']==0) echo $this->Html->link(__('Remove'), array('controller' => 'purchaseOrders', 'action' => 'removeline', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'purchase_order_details', 'action' => 'edit', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_order_details', 'action' => 'delete', $purchaseOrderDetail['id']), null, __('Are you sure you want to delete # %s?', $purchaseOrderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php echo $this->Form->input('shipping',array('id'=>'sc')); ?>
	<?php echo $this->Form->input('tax'); ?>

<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add Line'), array('controller' => 'purchaseOrders', 'action' => 'addline',$this->data['PurchaseOrder']['id'])); ?> </li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>