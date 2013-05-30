<div class="imageSettings index">
	<h2><?php echo __('Image Settings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('image_dir'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($imageSettings as $imageSetting): ?>
	<tr>
		<td><?php echo h($imageSetting['ImageSetting']['image_dir']); ?>&nbsp;</td>
		<td><?php echo h($imageSetting['ImageSetting']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$imageSetting['ImageSetting']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $imageSetting['ImageSetting']['id'])); ?>
			<?php if(count($imageSettings)>1) echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $imageSetting['ImageSetting']['id']), null, __('Are you sure you want to delete %s?', $imageSetting['ImageSetting']['image_dir'])); ?>
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
		<li><?php echo $this->Html->link(__('New Image Setting'), array('action' => 'add')); ?></li>
	</ul>
</div>
