<div class="receiptTypes form">
<?php echo $this->Form->create('ReceiptType'); ?>
	<fieldset>
		<legend><?php echo __('Add Receipt Type'); ?></legend>
	<?php

	echo $this->Form->input('name',array('id'=>'sc'));
		echo $this->Form->input('glAccount_id');
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>