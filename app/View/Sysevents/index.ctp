<div class="sysevents index">
	<h2><?php echo __('System Events History'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('created','Date'); ?></th>
			<th><?php echo $this->Paginator->sort('event_type'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($sysevents as $sysevent): ?>
	<tr>
		<td><?php echo h($sysevent['Sysevent']['created']); ?>&nbsp;</td>
		<td><?php echo $eventTypes[$sysevent['Sysevent']['event_type']]; ?>&nbsp;</td>
		<td><?php echo $sysevent['Sysevent']['title']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View Details'), array('action' => 'view', $sysevent['Sysevent']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $programsetting['Programsetting']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $programsetting['Programsetting']['id']), null, __('Are you sure you want to delete # %s?', $programsetting['Programsetting']['id'])); ?>
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
