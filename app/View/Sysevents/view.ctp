<div class="sysevents view">
<h2><?php  echo __('System Event: ').$sysevent['Sysevent']['title']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sysevent['Sysevent']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Type'); ?></dt>
		<dd>
			<?php echo h($eventTypes[$sysevent['Sysevent']['event_type']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($sysevent['Sysevent']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sysevent['Sysevent']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($sysevent['Sysevent']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Host IP'); ?></dt>
		<dd>
			<?php echo h($sysevent['Sysevent']['remoteaddr']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //debug($sysevent); ?>


<?php if (!empty($sysevent['Errorevent']['id'])): ?>
	<div class="related">
		<h3><?php echo __('Error Event Details'); ?></h3>
		<dl>
			<dt><?php echo __('Message'); ?></dt>
			<dd>
				<?php echo h($sysevent['Errorevent']['message']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
<?php endif; ?>
<div class="related">
	<?php if (!empty($group['User'])): ?>
	<h3><?php echo __('Related Users'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Homepage'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['homepage']; ?></td>
			<td><?php echo $user['active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
