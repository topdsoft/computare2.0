<div class="listTemplates index">
	<h2><?php echo __('List Templates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('removed'); ?></th>
			<th><?php echo $this->Paginator->sort('removed_id'); ?></th>
			<th><?php echo $this->Paginator->sort('newList_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('linkedTo_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($listTemplates as $listTemplate): ?>
	<tr>
		<td><?php echo h($listTemplate['ListTemplate']['id']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['created']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['created_id']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['active']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['removed']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['removed_id']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['newList_id']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['name']); ?>&nbsp;</td>
		<td><?php echo h($listTemplate['ListTemplate']['linkedTo_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $listTemplate['ListTemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $listTemplate['ListTemplate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $listTemplate['ListTemplate']['id']), null, __('Are you sure you want to delete # %s?', $listTemplate['ListTemplate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New List Template'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List List Questions'), array('controller' => 'list_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New List Question'), array('controller' => 'list_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
