<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Create New Item'); ?></legend>
	<?php
//		echo $this->Form->input('active');
		echo $this->Form->input('searialized');
//		echo $this->Form->input('Customer');
// 		echo $this->Form->input('ItemGroup');
// 		echo $this->Form->input('Image');
// 		echo $this->Form->input('Location');
// 		echo $this->Form->input('Vendor');
		echo $this->Form->end(__('Submit')); 
	?>
	</fieldset>
</div>
