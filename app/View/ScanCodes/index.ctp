<div class="scanCodes index">
	<h2><?php echo __('Scan Codes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('itemSerialNumber_id','Item Serial Number'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('print'); ?></th>
			<th><?php echo $this->Paginator->sort('internal'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($scanCodes as $scanCode): ?>
	<tr>
		<td><?php echo h($scanCode['ScanCode']['code']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($scanCode['Item']['name'], array('controller' => 'items', 'action' => 'view', $scanCode['Item']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($scanCode['Location']['name'], array('controller' => 'locations', 'action' => 'view', $scanCode['Location']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($scanCode['ItemSerialNumber']['id'], array('controller' => 'item_serial_numbers', 'action' => 'view', $scanCode['ItemSerialNumber']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($scanCode['User']['username'], array('controller' => 'users', 'action' => 'view', $scanCode['User']['id'])); ?>
		</td>
		<td><?php if($scanCode['ScanCode']['print']) echo 'Y'; ?>&nbsp;</td>
		<td><?php if($scanCode['ScanCode']['internal']) echo 'Y'; ?>&nbsp;</td>
		<td><?php echo h($scanCode['ScanCode']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$scanCode['ScanCode']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $scanCode['ScanCode']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $scanCode['ScanCode']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scanCode['ScanCode']['id']), null, __('Are you sure you want to delete # %s?', $scanCode['ScanCode']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Scan Code Lookup'), array('action' => 'lookup')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
	</ul>
</div>
