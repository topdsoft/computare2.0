<div class="projects view">
<h2><?php  echo __('Project: '.$project['Project']['name']); ?></h2>
	<dl>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($project['Project']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo $users[$project['Project']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($project['Project']['finished_id']): ?>
			<dt><?php echo __('Finished'); ?></dt>
			<dd>
				<?php echo h($project['Project']['finished']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('By'); ?></dt>
			<dd>
				<?php echo $users[$project['Project']['finished_id']]; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('Deadline'); ?></dt>
		<dd>
			<?php echo h($project['Project']['deadline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $project['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo nl2br($project['Project']['notes']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add', $project['Project']['id'],'redirect'=>array('controller'=>'projects','action'=>'view',$project['Project']['id']))); ?> </li>
	</ul>
</div>

<div class="related">
	<?php if (!empty($project['Task'])): ?>
	<h3><?php echo __('Tasks'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Task'); ?></th>
		<th><?php echo __('Deadline'); ?></th>
		<th><?php echo __('Est Hours'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Finished'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['Task'] as $task): ?>
		<tr>
			<td><?php echo $task['name']; ?></td>
			<td><?php echo $task['deadline']; ?></td>
			<td><?php echo $task['est_hours']; ?></td>
			<td><?php echo $task['created']; ?></td>
			<td><?php echo $users[$task['created_id']]; ?></td>
			<td><?php echo $task['finished']; ?></td>
			<td><?php echo $users[$task['finished_id']]; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tasks', 'action' => 'view', $task['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'tasks', 'action' => 'edit', $task['id'])); ?>
				<?php //echo $this->Form->postLink(__('Remove'), array('controller' => 'tasks', 'action' => 'delete', $task['id']), null, __('Are you sure you want to delete # %s?', $task['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($project['RemovedTask'])): ?>
	<h3><?php echo __('Removed Tasks'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Task'); ?></th>
		<th><?php echo __('Deadline'); ?></th>
		<th><?php echo __('Est Hours'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Finished'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Removed'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['RemovedTask'] as $task): ?>
		<tr>
			<td><?php echo $task['name']; ?></td>
			<td><?php echo $task['deadline']; ?></td>
			<td><?php echo $task['est_hours']; ?></td>
			<td><?php echo $task['created']; ?></td>
			<td><?php echo $users[$task['created_id']]; ?></td>
			<td><?php echo $task['finished']; ?></td>
			<td><?php echo $users[$task['finished_id']]; ?></td>
			<td><?php echo $task['removed']; ?></td>
			<td><?php echo $users[$task['removed_id']]; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tasks', 'action' => 'view', $task['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
