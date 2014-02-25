<div class="salesOrderFees form">
<?php echo $this->Form->create('SalesOrderFee'); ?>
	<fieldset>
		<legend><?php echo __('Add Sales Order Fee to: ').$soTypeName; ?></legend>
	<?php
		echo $this->Form->input('label');
		echo $this->Form->input('debitAccount_id',array('options'=>$glaccounts));
		echo $this->Form->input('creditAccount_id',array('options'=>$glaccounts));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('SalesOrderFeeLabel').focus();</script>