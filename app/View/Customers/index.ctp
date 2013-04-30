<div class="customers index">
<?php echo $this->Form->create('Customer'); ?>
	<h2><?php echo __('Customers'); ?></h2>
	<?php echo $this->element('filterblock'); ?>
	<?php echo $this->element('reportdetails'); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('CustomerDetail.companyName','Company'); ?></th>
			<th><?php echo $this->Paginator->sort('CustomerGroup.name','Group'); ?></th>
			<?php if($this->data['Filter']['showDeleted']) echo '<th>'.$this->Paginator->sort('active','Status').'</th>';?>
			<th></th>
	</tr>
	<?php 
	foreach ($customers as $customer): ?>
	<tr>
		<td><?php echo str_pad($customer['Customer']['id'],10,'0',STR_PAD_LEFT); ?>&nbsp;</td>
		<td><?php if($customer['Customer']['name']!=', ') echo h($customer['Customer']['name']);?>&nbsp;</td>
		<td><?php echo h($customer['CustomerDetail']['companyName']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($customer['CustomerGroup']['name'],array('controller'=>'customerGroups','action'=>'view',$customer['CustomerGroup']['id'])); ?>&nbsp;</td>
		<?php if($this->data['Filter']['showDeleted']) echo '<td>'.($customer['Customer']['active'] ? 'Active' : 'Deleted').'</td>';  ?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $customer['Customer']['id'])); ?>
			<?php if($customer['Customer']['active']) echo $this->Html->link(__('Edit'), array('action' => 'edit', $customer['Customer']['id'])); ?>
			<?php if($customer['Customer']['active']) echo $this->Html->link(__('Edit Pricing'), array('action' => 'editPricing', $customer['Customer']['id'])); ?>
			<?php if($customer['Customer']['active']) echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete customer: %s?', $customer['Customer']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customer Groups'), array('controller' => 'customerGroups', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Customer Detail'), array('controller' => 'customer_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
