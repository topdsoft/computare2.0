<div class="timeRecords form">
<?php echo $this->Html->css('timepopup'); ?>
<?php echo $this->Form->create('TimeRecord'); ?>
	<fieldset>
		<legend><?php echo __('Time Record User: '.$user['User']['username']); ?></legend>
	<?php 
		echo '<p><strong>System Time: </strong>'.$currentTime.'</p>';
		if($currentTask) {
			//show task user is working on
			echo '<p>';
			echo '<strong>Current Project:</strong>'.$currentTask['Project']['name'].'<br>';
			echo '<strong>Current Task:</strong>'.$currentTask['Task']['name'].'<br>';
			echo '<strong>Clocked In:</strong>'.date($currentTask['User']['date_time_format'],strtotime($currentTask['TimeRecord']['created'])).'<br>';
			$dt=new DateTime($currentTask['TimeRecord']['created']);
			$dt2=new DateTime(date('Y-m-d h:i:s'));
			$duration=$dt->diff($dt2);
			echo '<strong>Duration:</strong>'.$duration->format('%hh %im').'<br>';
			echo '</p>';
			echo $this->Form->button(__('Clock Out'),array('name'=>'out'));
		}//endif
		if(!empty($tasks)) echo '<br><br>'.$this->Form->input('task_id',array('label'=>'Start New Task:','after'=>$this->Form->end('Change Task')));
	?>
	</fieldset>
	<h3>Time Today</h3>
	<table>
	<tr><th>Clock In</th><th>Clock Out</th><th>Duration</th><th>Project</th><th>Task</th><tr>
	<?php
// debug($timeRecords);
		$total=0.0;
		foreach($timeRecords as $record) {
			//loop for all of todays time reords
			echo '<tr>';
			echo '<td>'.$record['TimeRecord']['created'].'</td>';
			echo '<td>'.$record['TimeRecord']['finished'].'</td>';
			echo '<td>'.$record['TimeRecord']['duration'].'</td>';
			$total+=$record['TimeRecord']['duration'];
			echo '<td>'.$projects[$record['Task']['project_id']].'</td>';
			echo '<td>'.$record['Task']['name'].'</td>';
			echo '</tr>';
		}//end foreach
		echo '<tr><td></td><td></td><td><strong>'.$total.'</strong></td><td></td><td></td></tr>';
	?>
	</table>
</div>
