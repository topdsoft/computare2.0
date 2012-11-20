<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Customer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('CustomerDetail.customer_id',array('type'=>'hidden'));
		echo $this->Form->input('CustomerDetail.companyName',array('id'=>'sc'));
		echo $this->Form->input('CustomerDetail.firstName');
		echo $this->Form->input('CustomerDetail.lastName');
		echo $this->Form->input('CustomerDetail.address1');
		echo $this->Form->input('CustomerDetail.address2');
		echo $this->Form->input('CustomerDetail.city');
		echo $this->Form->input('CustomerDetail.state');
		echo $this->Form->input('CustomerDetail.zip');
		echo $this->Form->input('CustomerDetail.email');
		echo $this->Form->input('CustomerDetail.phone');
		echo $this->Form->input('CustomerDetail.notes');
//		echo $this->Form->input('customerDetail_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>