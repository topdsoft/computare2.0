<div class="tasks form">
<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Edit Task: ').$this->data['Task']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('deadline');
		echo $this->Form->input('est_hours');
		echo $this->Form->input('notes');
		echo $this->Form->input('User',array('label'=>'Users Assigned to Task','multiple'=>'checkbox'));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Mark Task Finished'), array('action' => 'finish', $this->data['Task']['id'])); ?> </li>
	</ul>
</div>
