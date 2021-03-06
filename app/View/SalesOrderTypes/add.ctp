<div class="salesOrderTypes form">
<?php echo $this->Form->create('SalesOrderType'); ?>
	<fieldset>
		<legend><?php echo __('Add Sales Order Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('shipping',array('label'=>'Use Shipping','title'=>__('Flase: Items will be issued as sold, True: Items not issued until SO is shipped')));
		echo $this->Form->input('taxable');
		echo $this->Form->input('on_account');
		echo $this->Form->input('due_days',array('label'=>'Due Days (For sales on account)'));
		echo $this->Form->input('stock_required',array('title'=>__('False: If insufficient qty, inventory will show negative, True: Sale will fail if insufficient qty')));
		echo $this->Form->input('location_id');
		echo $this->Form->input('action');
		echo $this->Form->input('issueType');
		echo $this->Form->input('itemTotalDebitAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('itemTotalCreditAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('serviceTotalDebitAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('serviceTotalCreditAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('shippingDebitAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('shippingCreditAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('taxDebitAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('taxCreditAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('grandTotalDebitAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('grandTotalCreditAcct_id',array('options'=>$glaccounts));
		echo $this->Form->input('description',array('label'=>'Description (optional)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('SalesOrderTypeName').focus();</script>