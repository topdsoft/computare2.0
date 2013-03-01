<div class="programsettings index">
	<h2><?php echo __('Program Settings History'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('created','Date'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','Modified By'); ?></th>
			<th><?php echo $this->Paginator->sort('dbschema'); ?></th>
			<th><?php echo $this->Paginator->sort('full_name','Company Name'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($programsettings as $programsetting): ?>
	<tr>
		<td><?php echo h($programsetting['Programsetting']['created']); ?>&nbsp;</td>
		<td><?php echo h($userlist[$programsetting['Programsetting']['created_id']]); ?>&nbsp;</td>
		<td><?php echo h($programsetting['Programsetting']['dbschema']); ?>&nbsp;</td>
		<td><?php echo h($programsetting['Programsetting']['full_name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View Details'), array('action' => 'view', $programsetting['Programsetting']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Change Settings'), array('action' => 'edit')); ?></li>
	</ul>
</div>
