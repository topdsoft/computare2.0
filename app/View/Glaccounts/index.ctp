<div class="glaccounts index">
	<h2><?php echo __('Glaccounts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th><?php echo $this->Paginator->sort('glaccountdetail_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($glaccounts as $glaccount): ?>
	<tr>
		<td><?php echo h($glaccount['Glaccount']['id']); ?>&nbsp;</td>
		<td><?php echo h($glaccount['Glaccount']['created']); ?>&nbsp;</td>
		<td><?php echo h($glaccount['Glaccount']['created_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($glaccount['Glaccountdetail']['name'], array('controller' => 'glaccountdetails', 'action' => 'view', $glaccount['Glaccountdetail']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $glaccount['Glaccount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $glaccount['Glaccount']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $glaccount['Glaccount']['id']), null, __('Are you sure you want to delete # %s?', $glaccount['Glaccount']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Glaccount'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Glaccountdetails'), array('controller' => 'glaccountdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccountdetail'), array('controller' => 'glaccountdetails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glentries'), array('controller' => 'glentries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glentry'), array('controller' => 'glentries', 'action' => 'add')); ?> </li>
	</ul>
</div>
