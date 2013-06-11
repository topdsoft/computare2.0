<div class="tasks view">
<h2><?php  echo __('Task: ').$task['Task']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($task['Task']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($task['Project']['name'], array('controller' => 'projects', 'action' => 'view', $task['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deadline'); ?></dt>
		<dd>
			<?php echo h($task['Task']['deadline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Est Hours'); ?></dt>
		<dd>
			<?php echo h($task['Task']['est_hours']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($task['Task']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($task['Task']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo $users[$task['Task']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($task['Task']['finished']): ?>
			<dt><?php echo __('Finished'); ?></dt>
			<dd>
				<?php echo h($task['Task']['finished']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('By'); ?></dt>
			<dd>
				<?php echo $users[$task['Task']['finished_id']]; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($task['Task']['removed']): ?>
			<dt><?php echo __('Removed'); ?></dt>
			<dd>
				<?php echo h($task['Task']['removed']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Removed Id'); ?></dt>
			<dd>
				<?php echo h($task['Task']['removed_id']); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo nl2br($task['Task']['notes']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Task'), array('action' => 'edit', $task['Task']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($task['TimeRecord'])): ?>
	<h3><?php echo __('Task Time Records'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Finished'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Task Id'); ?></th>
		<th><?php echo __('Duration'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($task['TimeRecord'] as $timeRecord): ?>
		<tr>
			<td><?php echo $timeRecord['id']; ?></td>
			<td><?php echo $timeRecord['created']; ?></td>
			<td><?php echo $timeRecord['finished']; ?></td>
			<td><?php echo $timeRecord['user_id']; ?></td>
			<td><?php echo $timeRecord['task_id']; ?></td>
			<td><?php echo $timeRecord['duration']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'time_records', 'action' => 'view', $timeRecord['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'time_records', 'action' => 'edit', $timeRecord['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'time_records', 'action' => 'delete', $timeRecord['id']), null, __('Are you sure you want to delete # %s?', $timeRecord['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Time Record'), array('controller' => 'time_records', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<?php if (!empty($task['User'])): ?>
	<h3><?php echo __('Users Assigned to Task'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Time Logged'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($task['User'] as $user): ?>
		<tr>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['time']; ?></td>
			<td class="actions">
				<?php //echo $this->Form->postLink(__('Remove User from Task'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
