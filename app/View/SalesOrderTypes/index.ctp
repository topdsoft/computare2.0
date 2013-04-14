<div class="salesOrderTypes index">
	<h2><?php echo __('Sales Order Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('shipping'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($salesOrderTypes as $salesOrderType): ?>
	<tr>
		<td><?php echo h($salesOrderType['SalesOrderType']['name']); ?>&nbsp;</td>
		<td><?php echo h($salesOrderType['SalesOrderType']['shipping']); ?>&nbsp;</td>
		<td><?php echo h($salesOrderType['SalesOrderType']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$salesOrderType['SalesOrderType']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $salesOrderType['SalesOrderType']['id']), null, __('Are you sure you want to delete: %s?', $salesOrderType['SalesOrderType']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sales Order Type'), array('action' => 'add')); ?></li>
	</ul>
</div>
