<div class="salesOrderTypes form">
<?php echo $this->Form->create('SalesOrderType'); ?>
	<fieldset>
		<legend><?php echo __('Add Sales Order Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('shipping',array('label'=>'Use shipping'));
		echo $this->Form->input('taxable');
		echo $this->Form->input('on_account');
		echo $this->Form->input('location_id');
		echo $this->Form->input('action');
		echo $this->Form->input('glaccount_id');
		echo $this->Form->input('description',array('label'=>'Description (optional)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('SalesOrderTypeName').focus();</script>