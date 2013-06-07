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
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Item'); ?></th>
		<th><?php echo __('Current Qty'); ?></th>
		<th><?php echo __('Counted Qty'); ?></th>
		<th><?php echo __('Difference'); ?></th>
		<th></th>
	</tr>
	<?php
		$finished=true;
		foreach ($inventoryCount['Location'] as $location) {
			//loop for all locations in count
			$i = 0; 
			if($location['InventoryCountsLocation']['finished']) {
				//total qtys and check for difference
				$countBad=false;
				foreach($location['Item'] as $item_id=>$item) {
					//loop for all items and get totals
					if(!isset($item['curQty']))$location['Item'][$item_id]['curQty']=0;
					if(!isset($item['cntQty']))$location['Item'][$item_id]['cntQty']=0;
					//if either qty is unset then the count is bad
// 					if(!isset($item['curQty']) || !isset($item['cntQty'])) $countBad=true;
					//if qtys not equal then count is bad
					if($location['Item'][$item_id]['curQty']!=$location['Item'][$item_id]['cntQty']) $countBad=true;
				}//end foreach
				if($countBad)$finished=false;
			} else {
				//not finsished
				$finished=false;
			}//endif
			//show location on first line only
			echo '<tr><td>'.$this->Html->link($location['name'],array('controller'=>'locations','action'=>'view',$location['id'])).'</td>';
			if($location['InventoryCountsLocation']['finished']) echo '<td>Finished:'.$location['InventoryCountsLocation']['finished'].'</td>';
			else echo '<td>Incomplete</td>';
			if(empty($location['Item'])) echo '<td></td><td></td><td></td><td></td><td></td>';
			foreach ($location['Item'] as $item_id=>$item) {
				//loop for all items at location
				if($i>0) echo '<tr><td></td><td></td>';
				$i++;
				echo '<td>'.$this->Html->link($items[$item_id],array('controller'=>'items','action'=>'view',$item_id)).'</td>';
				if(isset($item['curQty'])) echo '<td>'.$item['curQty'].'</td>';
				else {
					echo '<td></td>';
					$item['curQty']=0;
				}//endif
				if(isset($item['cntQty'])) echo '<td>'.$item['cntQty'].'</td>';
				else { 
					echo '<td></td>';
					$item['cntQty']=0;
				}//endif
				echo '<td>'.($item['cntQty']-$item['curQty']).'</td>';
				if($i==1) {
					//only show actions on one line
					echo '<td class="actions">';
					if($location['InventoryCountsLocation']['finished'] && $countBad) {
						//show options for finsihed count
						echo $this->Html->link('Recount',array('action'=>'recount',$location['InventoryCountsLocation']['id']));
						echo $this->Html->link('Post Adjustment',array('action'=>'adjust',$location['InventoryCountsLocation']['id']));
					}
					echo '</td>';
				} else {
					//blanks
					echo '<td></td>';
				}//endif
			}//end foreach item
			echo '</tr>';
		}//end foreach location
	?>
	</table>
	<?php endif; ?>
</div>
<?php if(!$inventoryCount['InventoryCount']['finished']): ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inventory Count Locations'), array('action' => 'edit', $inventoryCount['InventoryCount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php if($finished)echo $this->Html->link(__('Finish Inventory Count'), array('action' => 'finishCount', $inventoryCount['InventoryCount']['id']));?></li>
	</ul>
</div>
<?php endif; ?>


