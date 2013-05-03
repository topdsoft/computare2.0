<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrderDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Item to Sales Order: ').$this->Form->value('SalesOrder.id'); ?></legend>
	<?php
// debug($this->data);
		echo "<p>Customer: ".$this->Html->link($this->data['Customer']['name'],array('controller'=>'customers','action'=>'view',$this->data['Customer']['id'])).'</p>';
		echo '<p>Sales Order Type: <strong title="'.$this->data['SalesOrderType']['description'].'">'.$this->data['SalesOrderType']['name'].'</strong></p>';
		echo $this->Form->input('item_id',array('after'=>$this->element('itemPopUp',array('inputId'=>'SalesOrderDetailItemId'))));
		echo $this->Form->input('qty');
		if(isset($priceRequired)) echo $this->Form->input('price',array('label'=>'Price Override (required)','div'=>'input number required'));
		if(isset($priceRequired)) echo "There is no default price for this item in the system.  To add one click ".$this->Html->link(__('Here'),array('controller'=>'items','action'=>'editPricing',$this->request->data['ItemDetail']['item_id']));
		else echo $this->Form->input('price',array('label'=>'Price Override (optional)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
