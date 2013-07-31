<div class="workflowChains form">
<?php echo $this->Form->create('Link'); ?>
	<fieldset>
		<legend><?php echo __('Add Link'); ?></legend>
	<?php
		echo $this->Form->input('controller');
		echo $this->Form->input('action');
		echo $this->Form->input('params',array('label'=>'Parameters (use ## for new_item_id)'));
		echo $this->Form->input('ordr',array('label'=>'Order'));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('LinkController').focus();</script>