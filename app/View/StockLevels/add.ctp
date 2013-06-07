<div class="stockLevels form">
<?php echo $this->Form->create('StockLevel'); ?>
	<fieldset>
		<legend><?php echo __('Add Stock Level'); ?></legend>
	<?php
		echo $this->Form->input('location_id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('qty');
		echo $this->Form->input('priority');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
