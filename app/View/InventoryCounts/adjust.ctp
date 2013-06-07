<div class="inventoryCounts view">
<?php echo $this->Form->create('InventoryCount'); ?>
	<fieldset>
	<legend><?php  echo __('Inventory Count Adjustment'); ?></legend>
	<dl>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($locationName,array('controller'=>'locations','action'=>'view',$location_id)); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Count Finished'); ?></dt>
		<dd>
			<?php echo h($finished); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo h($by); ?>
			&nbsp;
		</dd>
	</dl>
	<?php
		echo $this->Form->input('notes');
		echo '<table>';
		echo '<tr><th>Item</th><th>Current Qty</th><th>Counted Qty</th><th>Difference</th><th>Cost</th><th>Vendor</th></tr>';
		foreach($items as $item_id=>$item) {
			//loop for all items
			echo '<tr>';
			echo '<td>'.$this->Html->link($item['name'],array('controller'=>'items','action'=>'view',$item_id)).'</td>';
			echo "<td>{$item['curQty']}</td><td>{$item['cntQty']}</td><td>{$item['difference']}</td>";
			if($item['difference']<0) {
				//removing items
				echo '<td>'.$item['cost'].'</td><td></td>';
			} else {
				//adding items
				echo '<td>'.$this->Form->input($item_id.'.cost',array('label'=>'')).'</td>';
				echo '<td>'.$this->Form->input($item_id.'.vendor_id',array('label'=>'')).'</td>';
			}//endif
			echo '</tr>';
		}//end foreach
		echo '</table>';
		echo $this->Form->input('glAccount_id',array('label'=>'GL Inventory Account for Posting'));
	?>
</div>
<?php
// debug($inventoryCount);?>

