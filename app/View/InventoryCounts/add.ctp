<div class="inventoryCounts form">
<?php echo $this->Form->create('InventoryCount'); ?>
	<fieldset>
		<legend><?php echo __('Start New Inventory Count'); ?></legend>
		Click Submit to start a new inventory count.
	<?php
		echo $this->Form->input('notes');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
