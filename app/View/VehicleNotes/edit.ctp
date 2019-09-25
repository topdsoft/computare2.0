<div class="vehicleNotes form">
<?php echo $this->Form->create('VehicleNote'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vehicle Note: ').$this->data['Vehicle']['description']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('vehicle_id',array('type'=>'hidden'));
		echo $this->Form->input('note',array('id'=>'sc'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>
<?php //debug($this->data) ?>