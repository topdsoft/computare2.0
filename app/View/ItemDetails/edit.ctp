<div class="itemDetails form">
<?php echo $this->Form->create('ItemDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Item Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('created_id');
		echo $this->Form->input('name');
		echo $this->Form->input('sku');
		echo $this->Form->input('upc');
		echo $this->Form->input('item_id');
		echo $this->Form->input('category_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ItemDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ItemDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Item Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
