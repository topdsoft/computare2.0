<div class="locations form">
<?php echo $this->Form->create('Location'); ?>
	<fieldset>
		<legend><?php 
			if(isset($locationType)) echo __('Add Location').' of Type: '.$locationType['LocationType']['name']; 
			else echo __('Add Location'); 
		?></legend>
	<?php
// 		echo $this->Form->input('locationDetail_id');
// 		echo $this->Form->input('lft');
		echo $this->Form->input('LocationDetail.name');
 		if(!isset($locationType)) echo $this->Form->input('LocationDetail.locationType_id');
		echo $this->Form->input('parent_id');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('LocationDetailName').focus();</script>