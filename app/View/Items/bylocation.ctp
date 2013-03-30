<div class="items index">
	<h2><?php echo __('Items by Location'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Location.lft','Location'); ?></th>
			<th><?php echo $this->Paginator->sort('Item.name','Item'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th></th>
	</tr>
	<?php  
// debug($items);
	foreach ($items as $item): ?>
	<tr>
		<td><?php 
//echo $this->Html->link($locationsList[$item['ItemsLocation']['location_id']],array('controller'=>'locations','action'=>'view',$item['ItemsLocation']['id'])); 
			foreach($item['path'] as $i=>$path) {
				//loop for all locations in path
				if($i!=0) echo'->';
				echo $this->Html->link($path['Location']['name'],array('controller'=>'locations','action'=>'view',$path['Location']['id']));
			}//end foreach
		?>&nbsp;</td>
		<td><?php echo $this->Html->link($item['Item']['name'],array('controller'=>'items','action'=>'view',$item['ItemsLocation']['item_id'])); ?>&nbsp;</td>
		<td><?php echo h($item['ItemsLocation']['qty']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $item['ItemsLocation']['item_id'])); ?>
			<?php echo $this->Html->link(__('Receive'), array('action' => 'receive', $item['ItemsLocation']['item_id'], $item['ItemsLocation']['location_id'])); ?>
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
