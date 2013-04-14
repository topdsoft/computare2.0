<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrder'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sales Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('created_id');
		echo $this->Form->input('closed');
		echo $this->Form->input('closed_id');
		echo $this->Form->input('voided');
		echo $this->Form->input('voided_id');
		echo $this->Form->input('status');
		echo $this->Form->input('SalesOrderType_id');
		echo $this->Form->input('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SalesOrder.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SalesOrder.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sales Orders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales Order Types'), array('controller' => 'sales_order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Order Type'), array('controller' => 'sales_order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
