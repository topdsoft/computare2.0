<div class="workflowChains form">
<?php echo $this->Form->create('WorkflowChain'); ?>
	<fieldset>
		<legend><?php echo __('Add Workflow Chain'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('return_form');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('WorkflowChainName').focus();</script>