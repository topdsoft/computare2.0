<div class="glgroups view">
<h2><?php  echo __('Glgroup'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($glgroup['Glgroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($glgroup['Glgroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($glgroup['Glgroup']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($glgroup['Glgroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Glgroup'), array('action' => 'edit', $glgroup['Glgroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Glgroup'), array('action' => 'delete', $glgroup['Glgroup']['id']), null, __('Are you sure you want to delete # %s?', $glgroup['Glgroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Glgroups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glgroup'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glaccountdetails'), array('controller' => 'glaccountdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccountdetail'), array('controller' => 'glaccountdetails', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Glaccountdetails'); ?></h3>
	<?php if (!empty($glgroup['Glaccountdetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Glaccount Id'); ?></th>
		<th><?php echo __('Glgroup Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($glgroup['Glaccountdetail'] as $glaccountdetail): ?>
		<tr>
			<td><?php echo $glaccountdetail['id']; ?></td>
			<td><?php echo $glaccountdetail['created']; ?></td>
			<td><?php echo $glaccountdetail['created_id']; ?></td>
			<td><?php echo $glaccountdetail['glaccount_id']; ?></td>
			<td><?php echo $glaccountdetail['glgroup_id']; ?></td>
			<td><?php echo $glaccountdetail['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'glaccountdetails', 'action' => 'view', $glaccountdetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'glaccountdetails', 'action' => 'edit', $glaccountdetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'glaccountdetails', 'action' => 'delete', $glaccountdetail['id']), null, __('Are you sure you want to delete # %s?', $glaccountdetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Glaccountdetail'), array('controller' => 'glaccountdetails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
