<div class="inventoryCounts view">
<h2><?php  echo __('Inventory Count'); ?></h2>
	<dl>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inventoryCount['InventoryCount']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo $users[$inventoryCount['InventoryCount']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finished'); ?></dt>
		<dd>
			<?php echo h($inventoryCount['InventoryCount']['finished']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($inventoryCount['InventoryCount']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($inventoryCount['InventoryCount']['notes']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php
// debug($inventoryCount);?>
<div class="related">
	<?php if (!empty($inventoryCount['Location'])): ?>
	<h3><?php echo __('Count Locations'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Item'); ?></th>
		<th><?php echo __('Current Qty'); ?></th>
		<th><?php echo __('Counted Qty'); ?></th>
	</tr>
	<?php
		foreach ($inventoryCount['Location'] as $location) {
			//loop for all locations in count
			$i = 0;
			//show location on first line only
			echo '<tr><td>'.$this->Html->link($location['name'],array('controller'=>'locations','action'=>'view',$location['id'])).'</td>';
			if(empty($location['Item'])) echo '<td></td><td></td><td></td></tr>';
			foreach ($location['Item'] as $item_id=>$item) {
				//loop for all items at location
				if($i>0) echo '<tr><td></td>';
				$i++;
				echo '<td>'.$this->Html->link($items[$item_id],array('controller'=>'items','action'=>'view',$item_id)).'</td>';
				if(isset($item['curQty'])) echo '<td>'.$item['curQty'].'</td>';
				else echo '<td></td>';
				if(isset($item['cntQty'])) echo '<td>'.$item['cntQty'].'</td>';
				else echo '<td></td>';
				echo '</td>';
				echo '</tr>';
			}//end foreach item
		}//end foreach location
	?>
	</table>
<?php endif; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inventory Count'), array('action' => 'edit', $inventoryCount['InventoryCount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
	</ul>
</div>
