<div class="purchaseOrders form">
<?php echo $this->Form->create('PurchaseOrder'); ?>
	<fieldset>
		<legend><?php echo __('Add Line to Purchase Order: '),$this->data['PurchaseOrder']['id']; ?></legend>
	<?php
// debug($this->data);
		echo $this->Form->input('id');
		echo 'Vendor: '.$this->Html->link($this->data['Vendor']['name'],array('controller'=>'vendors','action'=>'view',$this->data['Vendor']['id']));
	?><br><br>
	<?php
		echo $this->Form->input('PurchaseOrderDetail.item_id',array('after'=>$this->element('itemPopUp',array('inputId'=>'PurchaseOrderDetailItemId'))));
		echo $this->Form->input('PurchaseOrderDetail.qty');
		echo $this->Form->input('PurchaseOrderDetail.cost');
	?>


<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Cancel'), array('controller' => 'purchaseOrders', 'action' => 'edit',$this->data['PurchaseOrder']['id'])); ?> </li>
	</ul>
</div>
