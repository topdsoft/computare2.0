<div class="glentries index">
	<h2><?php echo __('Glentries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('postDate'); ?></th>
			<th><?php echo $this->Paginator->sort('glaccount_id'); ?></th>
			<th><?php echo $this->Paginator->sort('glcheck_id'); ?></th>
			<th><?php echo $this->Paginator->sort('debit'); ?></th>
			<th><?php echo $this->Paginator->sort('credit'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($glentries as $glentry): ?>
	<tr>
		<td><?php echo h($glentry['Glentry']['id']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['created']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['created_id']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['postDate']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($glentry['Glaccount']['id'], array('controller' => 'glaccounts', 'action' => 'view', $glentry['Glaccount']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($glentry['Glcheck']['id'], array('controller' => 'glchecks', 'action' => 'view', $glentry['Glcheck']['id'])); ?>
		</td>
		<td><?php echo h($glentry['Glentry']['debit']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['credit']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $glentry['Glentry']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $glentry['Glentry']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $glentry['Glentry']['id']), null, __('Are you sure you want to delete # %s?', $glentry['Glentry']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Glentry'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Glaccounts'), array('controller' => 'glaccounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccount'), array('controller' => 'glaccounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glchecks'), array('controller' => 'glchecks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glcheck'), array('controller' => 'glchecks', 'action' => 'add')); ?> </li>
	</ul>
</div>
