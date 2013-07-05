<div class="locationTypes form">
<?php echo $this->Form->create('LocationType'); ?>
	<fieldset>
		<legend><?php echo __('Add Location Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('location_id',array('label'=>'Default Parent for new Locations (optional)'));
		echo $this->Form->input('default_name',array('label'=>'Default Name for new Locations (optional)'));
		echo $this->Form->input('next_number',array('label'=>'Next Number for appending to new Location Name (optional)'));
		echo $this->Form->input('description',array('label'=>'Description (optional)'));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('LocationTypeName').focus();</script>