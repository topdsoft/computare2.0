<div class="images form">
<?php echo $this->Form->create('Image'); ?>
	<fieldset>
		<legend><?php echo __('Edit Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Html->image($this->data['Image']['filename']);
// debug($this->data);
		echo $this->Form->input('item_id',array('label'=>'Add Image to Item:','after'=>$this->element('itemPopUp',array('inputId'=>'ImageItemId'))));
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete Image'), array('action' => 'delete', $this->Form->value('Image.id')), null, __('Are you sure you want to delete this item? (there is no undo)')); ?></li>
	</ul>
</div>
