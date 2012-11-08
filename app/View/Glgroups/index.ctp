<div class="glgroups index">
	<h2><?php echo __('GL Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('numAccounts','#Accounts'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($glgroups as $glgroup): ?>
	<tr>
		<td><?php echo h($glgroup['Glgroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($glgroup['Glgroup']['numAccounts']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $glgroup['Glgroup']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $glgroup['Glgroup']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $glgroup['Glgroup']['id']), null, __('Are you sure you want to delete # %s?', $glgroup['Glgroup']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Create GL Group'), array('action' => 'add')); ?></li>
	</ul>
</div>
