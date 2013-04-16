<div class="services index">
	<h2><?php echo __('Services'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php //echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('pricing'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('fixedRate'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','By'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($services as $service): ?>
	<tr>
		<td><?php echo h($service['Service']['name']); ?>&nbsp;</td>
		<td><?php //echo h($service['Service']['active']); ?>&nbsp;</td>
		<td><?php echo $pricingOptions[$service['Service']['pricing']]; ?>&nbsp;</td>
		<td><?php echo h($service['Service']['rate']); ?>&nbsp;</td>
		<td><?php if($service['Service']['fixedRate']) echo 'Y'; ?>&nbsp;</td>
		<td><?php echo h($service['Service']['created']); ?>&nbsp;</td>
		<td><?php echo $users[$service['Service']['created_id']]; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $service['Service']['id']), null, __('Are you sure you want to delete: %s?', $service['Service']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service'), array('action' => 'add')); ?></li>
	</ul>
</div>
