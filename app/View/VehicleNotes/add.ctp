<div class="vehicleNotes form">
<?php echo $this->Form->create('VehicleNote'); ?>
	<fieldset>
		<legend><?php echo __('Add Vehicle Note: ').$vehicles[$vehicle_id]; ?></legend>
	<?php
//		echo $this->Form->input('vehicle_id');
//		echo $this->Form->input('created_id');
		echo $this->Form->input('note',array('id'=>'sc'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //debug($vehicle_id) ?>
<script type='text/javascript'>document.getElementById('sc').focus();</script>