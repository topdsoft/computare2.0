<div class="glchecks form">
<?php echo $this->Form->create('Glcheck'); ?>
	<fieldset>
		<legend><?php echo __('Add Check'); ?></legend>
	<?php
		echo $this->Form->input('checkNumber');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Glchecks'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('GlcheckCheckNumber').focus();</script>