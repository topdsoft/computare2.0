<div class="timeRecords index">
	<h2><?php echo __('Time Records'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('finished'); ?></th>
			<th><?php echo $this->Paginator->sort('Task.project_id','Project'); ?></th>
			<th><?php echo $this->Paginator->sort('Task.name','Task'); ?></th>
			<th><?php echo $this->Paginator->sort('duration'); ?></th>
			<th><?php echo $this->Paginator->sort('notes'); ?></th>
			<th></th>
	</tr>
	<?php 
	foreach ($timeRecords as $timeRecord): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($timeRecord['User']['username'], array('controller' => 'users', 'action' => 'view', $timeRecord['User']['id'])); ?>
		</td>
		<td><?php echo h($timeRecord['TimeRecord']['created']); ?>&nbsp;</td>
		<td><?php echo h($timeRecord['TimeRecord']['finished']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($projects[$timeRecord['Task']['project_id']], array('controller' => 'projects', 'action' => 'view', $timeRecord['Task']['project_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($timeRecord['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $timeRecord['Task']['id'])); ?>
		</td>
		<td><?php echo h($timeRecord['TimeRecord']['duration']); ?>&nbsp;</td>
		<td><?php if($timeRecord['TimeRecord']['notes']) echo '<span title="'.$timeRecord['TimeRecord']['notes'].'">NOTES</span'; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timeRecord['TimeRecord']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Manual Time Entry'), array('action' => 'add')); ?> </li>
	</ul>
</div>
