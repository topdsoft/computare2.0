<div class="groups form">
<?php echo $this->Form->create('UserGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group ID:'.$this->data['UserGroup']['id']); ?></legend>
		<fieldset><legend><?php echo __('General Group Settings');?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name',array('id'=>'sc'));
			echo $this->Form->input('User',array('label'=>'Group Members','multiple'=>'checkbox'));
		?>
		<?php echo $this->Form->end(__('Submit')); ?>
		</fieldset>
		<h3><?php echo __('Group Permissions');?></h3>
	<table>
		<tr><th>Form</th><th>Form Group</th>
		<?php
			foreach($permissionsList as $perm) echo "<th>$perm</th>";
		?>
		<th></th></tr>
		<?php
			foreach($permissions as $set){
				//loop and display individual user permissions
				echo '<tr>';
				echo '<td>'.$set['Form']['name'].'</td>';
				echo '<td>'.$set['FormGroup']['name'].'</td>';
				foreach($permissionsList as $perm) {
					//loop for all permissions for this form or form group
					echo '<td>';
					if($set['PermissionSet'][$perm]) echo 'Y';
					echo '</td>';
				}//end foreach
				echo '<td class="actions">';
					echo $this->Html->link('Edit',array('controller'=>'permissionSets',
						'action'=>'edit',$set['PermissionSet']['id'],'redirect'=>array(
							'controller'=>'userGroups','action'=>'edit',$this->data['UserGroup']['id']
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
			'action' => 'addFormToUserGroup',$this->data['UserGroup']['id'],'redirect'=>array(
			'controller'=>'userGroups','action'=>'edit',$this->data['UserGroup']['id']))); ?></li>
		<li><?php echo $this->Html->link(__('New Form Group Permission'), array('controller'=>'permissionSets',
			'action' => 'addFormGroupToUserGroup',$this->data['UserGroup']['id'],'redirect'=>array(
			'controller'=>'userGroups','action'=>'edit',$this->data['UserGroup']['id']))); ?></li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>