<div class="tasks form">
<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend>
		<?php 
			if(isset($project))echo __('Add Task to Project: '.$project['Project']['name']); 
			else echo __('Add Task');
		?>
		</legend>
	<?php
		echo $this->Form->input('name');
		if(isset($project)) {
			//project passed in
			echo '<p><strong>Project: </strong>'.$this->Html->link($project['Project']['name'],array('controller'=>'projects','action'=>'view',$project['Project']['id']));
		} else {
			//project not set
			echo $this->Form->input('project_id');
		}//endif
		
		echo $this->Form->input('deadline',array('label'=>'Task Deadline (optional)','type'=>'text','after'=>$this->element('calendarPopUp',array('inputId'=>'TaskDeadline'))));
		echo $this->Form->input('est_hours',array('label'=>'Estimated Hours (optional)'));
		echo $this->Form->input('notes',array('label'=>'Notes (optional)'));
		echo $this->Form->input('User',array('label'=>'Add Users to Task','multiple'=>'checkbox'));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('TaskName').focus();</script>