<div class="tasks form">
<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Edit Task: ').$this->data['Task']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('deadline');
		echo $this->Form->input('est_hours');
		echo $this->Form->input('notes');
//		echo $this->Form->input('User',array('label'=>'Users Assigned to Task','multiple'=>'checkbox'));
		echo $this->Form->end(__('Submit'));
		echo '<h3>'.__('Users Assigned to Task').'</h3>';
// debug($this->data);
		echo '<table><tr><th>User</th><th>Hours Worked</th><th></th></tr>';
		foreach($this->data['User'] as $user) {
			//loop for all users
			if($user['UsersTask']['active']) {
				//only show users if active
				echo '<tr><td>'.$user['username'].'</td>';
				//total users hours
				$total=0.0;
				foreach($this->data['TimeRecord'] as $record) if($record['user_id']==$user['id']) $total+=$record['duration'];
				echo "<td>$total</td>";
				echo '<td class="actions">'.$this->Html->link(__('Remove User from Task'),array('action'=>'removeuser',$this->data['Task']['id'],$user['id'])).'</td>';
				echo '</tr>';
			}//endif
		}//end foreach
		echo '</table>';
	?>
	</fieldset>
<?php  ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add User to Task'), array('action' => 'adduser', $this->data['Task']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Mark Task Finished'), array('action' => 'finish', $this->data['Task']['id'])); ?> </li>
	</ul>
</div>
