<div class="itemCategories form">
<?php echo $this->Form->create('ItemCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Item Category'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'sc'));
		echo $this->Form->input('parent_id');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>