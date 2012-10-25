<div class="itemDetails index">
	<h2><?php echo __('Item Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('sku'); ?></th>
			<th><?php echo $this->Paginator->sort('upc'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($itemDetails as $itemDetail): ?>
	<tr>
		<td><?php echo h($itemDetail['ItemDetail']['id']); ?>&nbsp;</td>
		<td><?php echo h($itemDetail['ItemDetail']['created']); ?>&nbsp;</td>
		<td><?php echo h($itemDetail['ItemDetail']['created_id']); ?>&nbsp;</td>
		<td><?php echo h($itemDetail['ItemDetail']['name']); ?>&nbsp;</td>
		<td><?php echo h($itemDetail['ItemDetail']['sku']); ?>&nbsp;</td>
		<td><?php echo h($itemDetail['ItemDetail']['upc']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemDetail['Item']['id'], array('controller' => 'items', 'action' => 'view', $itemDetail['Item']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($itemDetail['Category']['name'], array('controller' => 'categories', 'action' => 'view', $itemDetail['Category']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemDetail['ItemDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemDetail['ItemDetail']['item_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemDetail['ItemDetail']['id']), null, __('Are you sure you want to delete # %s?', $itemDetail['ItemDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Item Detail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
