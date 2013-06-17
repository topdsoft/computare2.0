<div class="salesOrderTypes index">
	<h2><?php echo __('Sales Order Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('shipping'); ?></th>
			<th><?php echo $this->Paginator->sort('taxable'); ?></th>
			<th><?php echo $this->Paginator->sort('on_account'); ?></th>
			<th><?php echo $this->Paginator->sort('due_days'); ?></th>
			<th><?php echo $this->Paginator->sort('action'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('glaccount_id','GL acct'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($salesOrderTypes as $salesOrderType): ?>
	<tr>
		<td><?php echo h($salesOrderType['SalesOrderType']['name']); ?>&nbsp;</td>
		<td><?php if($salesOrderType['SalesOrderType']['shipping']) echo 'Y'; ?>&nbsp;</td>
		<td><?php if($salesOrderType['SalesOrderType']['taxable']) echo 'Y'; ?>&nbsp;</td>
		<td><?php if($salesOrderType['SalesOrderType']['on_account']) echo 'Y'; ?>&nbsp;</td>
		<td><?php if($salesOrderType['SalesOrderType']['due_days']) echo 'Y'; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($salesOrderType['SalesOrderType']['action'],array('controller'=>'salesOrders','action'=>$salesOrderType['SalesOrderType']['action'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($salesOrderType['Location']['name'],array('controller'=>'locations','action'=>'view',$salesOrderType['SalesOrderType']['location_id'])); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($salesOrderType['Glaccount']['name'],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['glaccount_id'])); ?>&nbsp;</td>
		<td><?php echo h($salesOrderType['SalesOrderType']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$salesOrderType['SalesOrderType']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'),array('action'=>'edit',$salesOrderType['SalesOrderType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Sales Orders'), array('controller'=>'salesOrders','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller'=>'locations','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List GL Accounts'), array('controller'=>'glaccounts','action' => 'index')); ?></li>
	</ul>
</div>
