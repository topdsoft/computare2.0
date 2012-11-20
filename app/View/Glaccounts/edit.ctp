<div class="glaccounts form">
<?php echo $this->Form->create('Glaccount'); ?>
	<fieldset>
		<legend><?php echo __('Edit GL Account'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('GlaccountDetail.glaccount_id',array('type'=>'hidden'));
		echo $this->Form->input('GlaccountDetail.glgroup_id',array('id'=>'sc','label'=>'GL Account Group'));
		echo $this->Form->input('GlaccountDetail.name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>