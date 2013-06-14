<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrder'); ?>
	<fieldset>
		<legend><?php echo __('Add Sales Order'); ?></legend>
	<?php
		echo $this->Form->input('customer_id',array('id'=>'sc','after'=>$this->element('customerPopUp',array('inputId'=>'sc'))));
		echo $this->Form->input('salesOrderType_id');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller'=>'customers','action' => 'edit','redirect'=>array('controller'=>'salesOrders','action'=>'add'))); ?> </li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>