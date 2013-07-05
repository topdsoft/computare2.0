<div class="locationTypes index">
	<h2><?php echo __('Location Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id','Default Location'); ?></th>
			<th><?php echo $this->Paginator->sort('default_name','Default Location Name'); ?></th>
			<th><?php echo $this->Paginator->sort('next_number'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($locationTypes as $locationType): ?>
	<tr>
		<td><?php echo h($locationType['LocationType']['name']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($locations[$locationType['LocationType']['location_id']],array('controller'=>'locations','action'=>'view',$locationType['LocationType']['location_id'])); ?>&nbsp;</td>
		<td><?php echo h($locationType['LocationType']['default_name']); ?>&nbsp;</td>
		<td><?php echo h($locationType['LocationType']['next_number']); ?>&nbsp;</td>
		<td><?php echo h($locationType['LocationType']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$locationType['LocationType']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('New Location'), array('controller'=>'locations','action' => 'add','locationType_id'=>$locationType['LocationType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $locationType['LocationType']['id']), null, __('Are you sure you want to delete Location Type %s?', $locationType['LocationType']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('New Location Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
