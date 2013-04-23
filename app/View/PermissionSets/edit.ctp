<div class="permissionSets form">
<?php echo $this->Form->create('PermissionSet'); ?>
	<fieldset>
		<legend>Edit Permissions for <?php 
			if($permissionSet['PermissionSet']['user_id']) echo 'User: '.$permissionSet['User']['username'];
			if($permissionSet['PermissionSet']['userGroup_id']) echo 'User Group: '.$permissionSet['UserGroup']['name'];
			if($permissionSet['PermissionSet']['form_id']) echo ' and Form: '.$permissionSet['Form']['name'];
			if($permissionSet['PermissionSet']['formGroup_id']) echo ' and Form Group: '.$permissionSet['FormGroup']['name'];
		?></legend>
		<?php
			foreach($permissionList as $permission) echo $this->Form->input($permission);
			echo $this->Form->end(__('Submit'));
		?>
	</fieldset>

	
<?php
// debug($permissionSet);?>
</div>