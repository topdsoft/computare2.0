<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrder'); ?>
	<fieldset>
		<legend><?php echo __('Add Sales Order'); ?></legend>
	<?php
		echo $this->Form->input('customer_id',array('id'=>'sc'));
		echo $this->Form->input('SalesOrderType_id');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>