<div class="glaccounts view">
<h2><?php  echo __('Glaccount'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($glaccount['Glaccount']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($glaccount['Glaccount']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($glaccount['Glaccount']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Glaccountdetail'); ?></dt>
		<dd>
			<?php echo $this->Html->link($glaccount['Glaccountdetail']['name'], array('controller' => 'glaccountdetails', 'action' => 'view', $glaccount['Glaccountdetail']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Glaccount'), array('action' => 'edit', $glaccount['Glaccount']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Glaccount'), array('action' => 'delete', $glaccount['Glaccount']['id']), null, __('Are you sure you want to delete # %s?', $glaccount['Glaccount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Glaccounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccount'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glaccountdetails'), array('controller' => 'glaccountdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccountdetail'), array('controller' => 'glaccountdetails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glentries'), array('controller' => 'glentries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glentry'), array('controller' => 'glentries', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Glentries'); ?></h3>
	<?php if (!empty($glaccount['Glentry'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('PostDate'); ?></th>
		<th><?php echo __('Glaccount Id'); ?></th>
		<th><?php echo __('Check Id'); ?></th>
		<th><?php echo __('Debit'); ?></th>
		<th><?php echo __('Credit'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($glaccount['Glentry'] as $glentry): ?>
		<tr>
			<td><?php echo $glentry['id']; ?></td>
			<td><?php echo $glentry['created']; ?></td>
			<td><?php echo $glentry['created_id']; ?></td>
			<td><?php echo $glentry['postDate']; ?></td>
			<td><?php echo $glentry['glaccount_id']; ?></td>
			<td><?php echo $glentry['check_id']; ?></td>
			<td><?php echo $glentry['debit']; ?></td>
			<td><?php echo $glentry['credit']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'glentries', 'action' => 'view', $glentry['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'glentries', 'action' => 'edit', $glentry['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'glentries', 'action' => 'delete', $glentry['id']), null, __('Are you sure you want to delete # %s?', $glentry['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Glentry'), array('controller' => 'glentries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
