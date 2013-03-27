<div class="items form">
<?php echo $this->Form->create('Item'); ?>
<?php if ($this->data) $new=false; else $new=true; ?>
	<fieldset>
		<legend><?php if($new) echo __('Add Item'); else echo __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		if($new) echo $this->Form->input('serialized');
		echo $this->Form->input('ItemDetail.name',array('id'=>'sc'));
		echo $this->Form->input('ItemDetail.sku');
		echo $this->Form->input('ItemDetail.upc');
		echo $this->Form->input('ItemGroup');
// debug($this->data);
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>