<div class="addresses form">
<?php echo $this->Form->create('Address'); ?>
	<fieldset>
		<legend><?php echo __('Edit Address for '.$name); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('id'=>'sc'));
		echo $this->Form->input('vendor_id',array('type'=>'hidden'));
		echo $this->Form->input('customer_id',array('type'=>'hidden'));
		echo $this->Form->input('line1');
		echo $this->Form->input('line2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('active',array('type'=>'hidden'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>