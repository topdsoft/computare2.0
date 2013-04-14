<div class="salesOrderTypes form">
<?php echo $this->Form->create('SalesOrderType'); ?>
	<fieldset>
		<legend><?php echo __('Add Sales Order Type'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
		echo $this->Form->input('shipping',array('label'=>'Use shipping'));
		echo $this->Form->input('description',array('label'=>'Description (optional)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>