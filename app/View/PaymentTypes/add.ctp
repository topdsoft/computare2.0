<div class="paymentTypes form">
<?php echo $this->Form->create('PaymentType'); ?>
	<fieldset>
		<legend><?php echo __('Add Payment Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('identification_label',array('label'=>'Identification Label (optional)'));
		echo $this->Form->input('gl_expense_account_id',array('label'=>'GL Expense Account (optional)'));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('PaymentTypeName').focus();</script>