<div class="itemGroups index">
	<h2><?php echo __('Item Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($itemGroups as $itemGroup): ?>
	<tr>
		<td><?php echo h($itemGroup['ItemGroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($itemGroup['ItemGroup']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$itemGroup['ItemGroup']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemGroup['ItemGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemGroup['ItemGroup']['id'])); ?>
			<?php // echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemGroup['ItemGroup']['id']), null, __('Are you sure you want to delete # %s?', $itemGroup['ItemGroup']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Item Group'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller'=>'items','action' => 'index')); ?></li>
	</ul>
</div>
