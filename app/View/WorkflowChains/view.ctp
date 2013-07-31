<div class="workflowChains view">
<h2><?php  echo __('Workflow Chain'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['removed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed Id'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['removed_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Return Form'); ?></dt>
		<dd>
			<?php echo h($workflowChain['WorkflowChain']['return_form']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Workflow Chain'), array('action' => 'edit', $workflowChain['WorkflowChain']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Workflow Chain'), array('action' => 'delete', $workflowChain['WorkflowChain']['id']), null, __('Are you sure you want to delete # %s?', $workflowChain['WorkflowChain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Workflow Chains'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workflow Chain'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Links'), array('controller' => 'links', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link'), array('controller' => 'links', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Links'); ?></h3>
	<?php if (!empty($workflowChain['Link'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Removed'); ?></th>
		<th><?php echo __('Removed Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('WorkflowChain Id'); ?></th>
		<th><?php echo __('Form'); ?></th>
		<th><?php echo __('Ordr'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($workflowChain['Link'] as $link): ?>
		<tr>
			<td><?php echo $link['id']; ?></td>
			<td><?php echo $link['created']; ?></td>
			<td><?php echo $link['created_id']; ?></td>
			<td><?php echo $link['removed']; ?></td>
			<td><?php echo $link['removed_id']; ?></td>
			<td><?php echo $link['active']; ?></td>
			<td><?php echo $link['workflowChain_id']; ?></td>
			<td><?php echo $link['form']; ?></td>
			<td><?php echo $link['ordr']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'links', 'action' => 'view', $link['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'links', 'action' => 'edit', $link['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'links', 'action' => 'delete', $link['id']), null, __('Are you sure you want to delete # %s?', $link['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Link'), array('controller' => 'links', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
