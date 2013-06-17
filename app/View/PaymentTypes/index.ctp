<div class="paymentTypes index">
	<h2><?php echo __('Payment Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('identification_label'); ?></th>
			<th><?php echo $this->Paginator->sort('gl_expense_account_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($paymentTypes as $paymentType): ?>
	<tr>
		<td><?php echo h($paymentType['PaymentType']['name']); ?>&nbsp;</td>
		<td><?php echo h($paymentType['PaymentType']['identification_label']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentType['Glaccount']['name'], array('controller' => 'glaccounts', 'action' => 'view', $paymentType['Glaccount']['id'])); ?>
		</td>
		<td><?php echo h($paymentType['PaymentType']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$paymentType['PaymentType']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paymentType['PaymentType']['id']), null, __('Are you sure you want to delete payment type %s?', $paymentType['PaymentType']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List GL Accounts'), array('controller' => 'glaccounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Orders'), array('controller' => 'salesOrders', 'action' => 'index')); ?> </li>
	</ul>
</div>
