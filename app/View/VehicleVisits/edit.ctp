<div class="vehicleVisits form">
<?php echo $this->Form->create('VehicleVisit'); ?>
	<fieldset>
		<legend><?php echo __('Check Vehicle Out: ').$this->Form->data['Vehicle']['description']; ?></legend>
	<?php
		echo $this->Form->input('id');
//		echo $this->Form->input('created_id');
//		echo $this->Form->input('created');
//		echo $this->Form->input('exit_id');
		echo $this->Form->input('vehicle_id',array('type'=>'hidden'));
//debug($this->Form->data);
	?>
	<strong>Entered Shop: </strong>
	<?php echo $this->Form->data['VehicleVisit']['created']; ?>
	</fieldset>
<?php echo $this->Form->end(__('Confirm')); ?>
</div>
