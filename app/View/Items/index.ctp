<div class="items index">
	<h2><?php echo __('Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('ItemCategory.name','Category'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('serialized'); ?></th>
			<th></th>
	</tr>
	<?php  //debug($items);
	foreach ($items as $item): ?>
	<tr>
		<td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['qty']); ?>&nbsp;</td>
		<td><?php
//echo $this->Html->link($item['ItemCategory']['name'],array('controller'=>'itemCategories','action'=>'view',$item['ItemCategory']['id'])); 
			if($item['path']) {
				foreach($item['path'] as $i=>$path) {
					//loop for each step of path
					if($i!=0) echo '->';
					echo $this->Html->link($path['ItemCategory']['name'],array('controller'=>'itemCategories','action'=>'view',$path['ItemCategory']['id']));
				}//endforeach
			}//endif
		?>&nbsp;</td>
		<td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
		<td><?php if($item['Item']['serialized']) echo 'Y'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Pricing'), array('action' => 'editPricing', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Receive'), array('action' => 'receive', $item['Item']['id'])); ?>
			<?php // echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?></li>
	</ul>
</div>
