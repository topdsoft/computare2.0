<div class="receiptTypes index">
	<h2><?php echo __('Receipt Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('Glaccount.name','GL Account'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php //debug($receiptTypes);
	foreach ($receiptTypes as $receiptType): ?>
	<tr>
		<td><?php echo h($receiptType['ReceiptType']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($receiptType['Glaccount']['name'], array('controller' => 'glaccounts', 'action' => 'view', $receiptType['Glaccount']['id'])); ?>
		</td>
		<td><?php echo h($receiptType['ReceiptType']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$receiptType['ReceiptType']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $issueType['ReceiptType']['id']), null, __('Are you sure you want to delete # %s?', $issueType['IssueType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Receipt Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Glaccounts'), array('controller' => 'glaccounts', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Glaccount'), array('controller' => 'glaccounts', 'action' => 'add')); ?> </li>
	</ul>
</div>
