<div class="backups index">
	<h2><?php echo __('Backups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th><?php echo $this->Paginator->sort('since'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
	</tr>
	<?php
	foreach ($backups as $backup): ?>
	<tr>
		<td><?php echo h($backup['Backup']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$backup['Backup']['created_id']]; ?>&nbsp;</td>
		<td><?php echo h($backup['Backup']['since']); ?>&nbsp;</td>
		<td><?php echo '<a href="'.$backup['Backup']['filename'].'" title="Click here to download backup file."
			>'.$backup['Backup']['filename'].'</a>';?>&nbsp;</td> 
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
		<li><?php echo $this->Html->link(__('New Backup'), array('action' => 'add')); ?></li>
	</ul>
</div>
