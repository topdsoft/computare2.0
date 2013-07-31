<div class="workflowChains index">
	<h2><?php echo __('Workflow Chains'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('return_form'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($workflowChains as $workflowChain): ?>
	<tr>
		<td><?php echo h($workflowChain['WorkflowChain']['name']); ?>&nbsp;</td>
		<td><?php echo h($workflowChain['WorkflowChain']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$workflowChain['WorkflowChain']['created_id']]; ?>&nbsp;</td>
		<td><?php echo h($workflowChain['WorkflowChain']['return_form']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Run'), array('action' => 'run', $workflowChain['WorkflowChain']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $workflowChain['WorkflowChain']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $workflowChain['WorkflowChain']['id']), null, __('Are you sure you want to delete # %s?', $workflowChain['WorkflowChain']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Workflow Chain'), array('action' => 'add')); ?></li>
	</ul>
</div>
