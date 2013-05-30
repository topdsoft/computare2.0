<div class="images form">
<?php echo $this->Form->create('Image',array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Upload Images'); ?></legend>
		You may upload up to 20 files at a time, but they can not exceed 16MB total.
	<?php
		echo $this->Form->file('Image/name1',array('multiple','name'=>'data[Images][]'));
	?>
	<?php echo $this->Form->end(__('Submit'));?>
	</fieldset>
</div>
