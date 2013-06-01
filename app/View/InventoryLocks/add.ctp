<div class="inventoryLocks form">
<?php echo $this->Form->create('InventoryLock'); ?>
	<fieldset>
		<legend><?php echo __('Add Inventory Lock'); ?></legend>
	<?php
		echo $this->Form->input('notes',array('id'=>'sc','label'=>'Notes (optional)'));
		echo $this->Form->input('location_id');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>