<div class="itemCategories index">
	<h2><?php echo __('Item Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($itemCategories as $itemCategory): ?>
	<tr>
		<td><?php echo h($itemCategory['ItemCategory']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemCategory['ParentItemCategory']['name'], array('controller' => 'item_categories', 'action' => 'view', $itemCategory['ParentItemCategory']['id'])); ?>
		</td>
		<td><?php echo h($itemCategory['ItemCategory']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$itemCategory['ItemCategory']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemCategory['ItemCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemCategory['ItemCategory']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemCategory['ItemCategory']['id']), null, __('Are you sure you want to delete # %s?', $itemCategory['ItemCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Item Category'), array('action' => 'add')); ?></li>
	</ul>
</div>
