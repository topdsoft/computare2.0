<div class="glentries index">
<?php echo $this->Form->create('Filter'); ?>
	<h2><?php echo __('General Ledger Entries'); ?></h2>
	<?php echo $this->element('filterblock'); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Glaccount.group','GL Group'); ?></th>
			<th><?php echo $this->Paginator->sort('Glaccount.name','Account'); ?></th>
			<th><?php echo $this->Paginator->sort('debit'); ?></th>
			<th><?php echo $this->Paginator->sort('credit'); ?></th>
			<th><?php echo $this->Paginator->sort('postDate','Posting Date'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Date Entered'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','Entered By'); ?></th>
			<th>Notes</th>
			<th><?php echo $this->Paginator->sort('glcheck_id','Check#'); ?></th>
	</tr>
	<?php 
	foreach ($glentries as $glentry): ?>
	<tr>
		<td><?php echo h($glentry['Glaccount']['group']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($glentry['Glaccount']['name'], array('controller' => 'glaccounts', 'action' => 'view', $glentry['Glaccount']['id'])); ?>
		</td>
		<td><?php echo h($glentry['Glentry']['debit']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['credit']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['postDate']); ?>&nbsp;</td>
		<td><?php echo h($glentry['Glentry']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$glentry['Glentry']['created_id']]; ?>&nbsp;</td>
		<td><?php if($glentry['Glnote']['text']) echo '<span title="'.$glentry['Glnote']['text'].'">NOTES</span'; ?></td>
		<td><?php echo h($glentry['Glcheck']['checkNumber']); ?>&nbsp;</td>
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
