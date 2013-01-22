<div class="programsettings form">
<?php echo $this->Form->create('Programsetting'); ?>
	<fieldset>
		<legend><?php echo __('Initial Program Settings'); ?></legend>
	<?php
//		echo $this->Form->input('created_id');
//		echo $this->Form->input('dbschema');
		echo $this->Form->input('full_name',array('label'=>'Full Name of Company','id'=>'fn'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('fn').focus();</script>