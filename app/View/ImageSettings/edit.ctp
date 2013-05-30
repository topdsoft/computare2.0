<div class="imageSettings form">
<?php echo $this->Form->create('ImageSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Image Setting'); ?></legend>
	<?php
		echo $this->Form->input('image_dir',array('id'=>'sc'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>