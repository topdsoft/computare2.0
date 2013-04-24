<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User ID:'.$this->data['User']['id']); ?></legend>
		<fieldset><legend>General User Settings</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('username');
	//		echo $this->Form->input('password');
			echo $this->Form->input('email');
			echo $this->Form->input('homepage');
// 			echo '<h3>User Groups</h3>';
			echo $this->Form->input('UserGroup',array('label'=>'Set User Groups (this can change permissions)','multiple'=>'checkbox'));
	// 		echo $this->Form->input('Form',array('label'=>'Set Individual Forms'));
	//  debug($perms);
		?>
<?php echo $this->Form->end(__('Submit')); ?>
		</fieldset>
	<h3>Individual User Permissions</h3>
	<table>
		<tr><th>Form</th><th>Form Group</th>
		<?php
			foreach($permList as $perm) echo "<th>$perm</th>";
		?>
		<th></th></tr>
		<?php
			foreach($perms as $set){
				//loop and display individual user permissions
				echo '<tr>';
				echo '<td>'.$set['Form']['name'].'</td>';
				echo '<td>'.$set['FormGroup']['name'].'</td>';
				foreach($permList as $perm) {
					//loop for all permissions for this form or form group
					echo '<td>';
					if($set['PermissionSet'][$perm]) echo 'Y';
					echo '</td>';
				}//end foreach
				echo '<td class="actions">';
					echo $this->Html->link('Edit',array('controller'=>'permissionSets',
						'action'=>'edit',$set['PermissionSet']['id'],'redirect'=>array(
							'controller'=>'users','action'=>'edit',$this->data['User']['id']
						)));
				echo '</td></tr>';
			}//end foreach
		?>
	</table>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Form Permission'), array('controller'=>'permissionSets',
			'action' => 'addFormToUser',$this->data['User']['id'],'redirect'=>array(
			'controller'=>'users','action'=>'edit',$this->data['User']['id']))); ?></li>
		<li><?php echo $this->Html->link(__('New Form Group Permission'), array('controller'=>'permissionSets',
			'action' => 'addFormGroupToUser',$this->data['User']['id'],'redirect'=>array(
			'controller'=>'users','action'=>'edit',$this->data['User']['id']))); ?></li>
	</ul>
</div>
