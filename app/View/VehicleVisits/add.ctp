<div class="vehicleVisits form">
<?php echo $this->Form->create('VehicleVisit'); ?>
	<fieldset>
		<legend><?php echo __('Check Vehicle In: ').$vehicles[$vehicle_id]; ?></legend>
	<?php
//		echo $this->Form->input('created_id');
//		echo $this->Form->input('exits');
//		echo $this->Form->input('exit_id');
//		echo $this->Form->input('vehicle_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Confirm')); ?>
</div>
