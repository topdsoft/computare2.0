<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrderDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Item to Sales Order: ').$this->Form->value('SalesOrder.id'); ?></legend>
	<?php
// debug($this->data);
		echo "<p>Customer: ".$this->Html->link($this->data['Customer']['name'],array('controller'=>'customers','action'=>'view',$this->data['Customer']['id'])).'</p>';
		echo '<p>Sales Order Type: <strong title="'.$this->data['SalesOrderType']['description'].'">'.$this->data['SalesOrderType']['name'].'</strong></p>';
		echo $this->Form->input('item_id');
		echo $this->Form->input('qty');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
