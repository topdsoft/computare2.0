<div class="itemGroups form">
<?php echo $this->Form->create('ItemGroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Item Group'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>