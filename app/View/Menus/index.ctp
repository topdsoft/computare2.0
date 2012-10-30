<div class="menus index">
	<h2><?php echo __('Menus'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id','Owner'); ?></th>
			<th><?php echo $this->Paginator->sort('links','#Links'); ?></th>
			<th><?php echo $this->Paginator->sort('users','#Users'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($menus as $menu): ?>
	<tr>
		<td><?php echo h($menu['Menu']['name']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['created']); ?>&nbsp;</td>
		<td><?php echo h($users[$menu['Menu']['created_id']]); ?>&nbsp;</td>
		<td><?php echo h($users[$menu['Menu']['user_id']]); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['links']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['users']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?>
			<?php if($menu['Menu']['user_id']==0) echo $this->Html->link(__('Edit Menu Users'), array('action' => 'editusers', $menu['Menu']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	<td class="actions"><?php echo $this->Html->link(__('Create New Menu'), array('controller' => 'menus', 'action' => 'add'), array('class'=>'actions')); ?></td>
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
