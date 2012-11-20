<div class="glaccounts index">
	<h2><?php echo __('GL Accounts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('group'); ?></th>
			<th><?php echo $this->Paginator->sort('glaccountDetail.name','Name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','Created By'); ?></th>
			<th></th>
	</tr>
	<?php 
	foreach ($glaccounts as $glaccount): ?>
	<tr>
		<td><?php echo h($glgroups[$glaccount['GlaccountDetail']['glgroup_id']]); ?>&nbsp;</td>
		<td><?php echo h($glaccount['GlaccountDetail']['name']); ?>&nbsp;</td>
		<td><?php echo h($glaccount['Glaccount']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$glaccount['Glaccount']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $glaccount['Glaccount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $glaccount['Glaccount']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New GL Account'), array('action' => 'add')); ?></li>
	</ul>
</div>
