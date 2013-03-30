<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('ItemDetail.name',array('id'=>'sc'));
		echo $this->Form->input('serialized');
		echo $this->Form->input('ItemDetail.sku');
		echo $this->Form->input('ItemDetail.upc');
		if($itemGroups) echo $this->Form->input('ItemGroup',array('multiple'=>'checkbox','label'=>'Item Groups'));
		if($categories) echo $this->Form->input('category_id',array('label'=>'Item Category'));
// debug($this->data);
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>