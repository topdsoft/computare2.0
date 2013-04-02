<div class="purchaseOrders form">
<?php echo $this->Form->create('PurchaseOrder'); ?>
	<fieldset>
		<legend><?php echo __('Add Purchase Order'); ?></legend>
	<?php
		echo $this->Form->input('vendor_id',array('id'=>'sc'));
		echo $this->Form->input('allowOpen');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>