<div class="backups form">
<?php echo $this->Form->create('Backup'); ?>
	<fieldset>
		This action will backup the database into a *.sql file.
		<legend><?php echo __('Backup Database'); ?></legend>
	<?php
// 		echo $this->Form->input('created_id');
// 		echo $this->Form->input('filename');
	?>
<?php echo $this->Form->end(__('Perform Backup')); ?>
	</fieldset>
</div>
