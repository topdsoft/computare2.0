<div class="itemGroups form">
<?php echo $this->Form->create('ItemGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Item Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('id'=>'sc'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>