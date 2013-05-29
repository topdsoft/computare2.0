<div class="programsettings form">
<?php echo $this->Form->create('Programsetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Programsetting'); ?></legend>
	<?php
		echo $this->Form->input('dbschema',array('type'=>'hidden'));
		echo $this->Form->input('cost_method',array('type'=>'hidden'));
		echo $this->Form->input('full_name',array('id'=>'fn'));
		echo $this->Form->input('backup_file_dir');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('fn').focus();</script>