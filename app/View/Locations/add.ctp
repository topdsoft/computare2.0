<div class="locations form">
<?php echo $this->Form->create('Location'); ?>
	<fieldset>
		<legend><?php echo __('Add Location'); ?></legend>
	<?php
// 		echo $this->Form->input('locationDetail_id');
// 		echo $this->Form->input('lft');
// 		echo $this->Form->input('rght');
		echo $this->Form->input('LocationDetail.name',array('id'=>'sc'));
		echo $this->Form->input('parent_id');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>