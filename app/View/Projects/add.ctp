<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Add Project'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('deadline',array('type'=>'text','label'=>'Deadline (optional)','after'=>$this->element('calendarPopUp',array('inputId'=>'ProjectDeadline'))));
		echo $this->Form->input('customer_id');
		echo $this->Form->input('notes');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('ProjectName').focus();</script>