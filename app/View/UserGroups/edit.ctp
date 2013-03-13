<div class="groups form">
<?php echo $this->Form->create('UserGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group ID:'.$this->data['UserGroup']['id']); ?></legend>
	<?php
		echo $this->Form->input('id');
//		echo $this->Form->input('created_id');
		echo $this->Form->input('name',array('id'=>'sc'));
		echo $this->Form->input('User',array('label'=>'Group Members'));
		echo $this->Form->input('Form',array('label'=>'Group Permissions'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>