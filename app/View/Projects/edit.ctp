<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Edit Project: ').$this->data['Project']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('notes');
		echo $this->Form->end(__('Submit'));
	?>
	<?php if(!empty($this->data['Task'])): ?>
		<H3>Tasks</h3>
		<table>
		<tr>
		<th>Task</th><th>Id</th><th>Status</th><th>Hrs Estimated</th><th>Hrs Completed</th><th></th>
		<?php
			foreach($this->data['Task'] as $task) {
				//loop for all tasks
				echo '<tr>';
				echo '<td>'.$task['name'],'</td>';
				echo '<td>'.$task['id'],'</td>';
				echo '<td>';
				if($task['finished']) echo 'Finished';
				else echo 'Ongoing';
				echo '</td>';
				echo '<td>'.$task['est_hours'],'</td>';
				echo '<td>'.$task['sumDuration'].'</td>';
				echo '<td class="actions">';
				echo $this->Html->link(__('View'), array('action' => 'view', $task['id']));
				echo '</td>';
				echo '</tr>';
			}//end foreach
		?>
		</tr>
		</table>
	<?php endif; ?>
	</fieldset>
<?php 
// debug($this->data);?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Project.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Project.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add',$this->data['Project']['id'],'redirect'=>array('controller'=>'projects','action'=>'edit',$this->data['Project']['id']))); ?> </li>
	</ul>
</div>
