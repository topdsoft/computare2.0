<div class="salesOrderTypes form">
<?php echo $this->Form->create('SalesOrderType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sales Order Type: ').$this->data['SalesOrderType']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('action');
		echo $this->Form->input('description',array('label'=>'Description (optional)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('SalesOrderTypeDescription').focus();</script>