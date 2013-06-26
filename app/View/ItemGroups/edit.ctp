<div class="itemGroups form">
<?php echo $this->Form->create('ItemGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Item Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<script type='text/javascript'>document.getElementById('ItemGroupName').focus();</script>