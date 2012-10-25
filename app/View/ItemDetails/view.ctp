<div class="itemDetails view">
<h2><?php  echo __('Item Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemDetail['ItemDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itemDetail['ItemDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($itemDetail['ItemDetail']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($itemDetail['ItemDetail']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sku'); ?></dt>
		<dd>
			<?php echo h($itemDetail['ItemDetail']['sku']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Upc'); ?></dt>
		<dd>
			<?php echo h($itemDetail['ItemDetail']['upc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemDetail['Item']['id'], array('controller' => 'items', 'action' => 'view', $itemDetail['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemDetail['Category']['name'], array('controller' => 'categories', 'action' => 'view', $itemDetail['Category']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Detail'), array('action' => 'edit', $itemDetail['ItemDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item Detail'), array('action' => 'delete', $itemDetail['ItemDetail']['id']), null, __('Are you sure you want to delete # %s?', $itemDetail['ItemDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
