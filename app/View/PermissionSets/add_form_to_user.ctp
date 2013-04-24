<div class="permissionSet form">
<?php echo $this->Form->create('PermissionSet'); ?>
	<fieldset>
		<legend><?php echo __('Add Form Permissions for User: ').$userName; ?></legend>
		<?php echo $this->Form->input('form_id'); ?>
		<?php echo $this->Form->end('Submit'); ?>
	</fieldset>
</div>