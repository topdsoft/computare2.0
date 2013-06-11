<div class="timeRecords view">
<h2><?php  echo __('Time Record'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timeRecord['TimeRecord']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($timeRecord['TimeRecord']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finished'); ?></dt>
		<dd>
			<?php echo h($timeRecord['TimeRecord']['finished']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeRecord['User']['username'], array('controller' => 'users', 'action' => 'view', $timeRecord['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timeRecord['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $timeRecord['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($timeRecord['TimeRecord']['duration']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Time Record'), array('action' => 'edit', $timeRecord['TimeRecord']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Time Record'), array('action' => 'delete', $timeRecord['TimeRecord']['id']), null, __('Are you sure you want to delete # %s?', $timeRecord['TimeRecord']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Time Records'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Time Record'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
