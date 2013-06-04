<div class="inventoryCounts form">
<?php echo $this->Form->create('InventoryCount'); ?>
	<fieldset>
		<legend><?php echo __('Inventory Counting'); ?></legend>
	<?php
		echo nl2br($inventoryCount['InventoryCount']['notes']);
	?>
	<h3>Location</h3>
	<?php 
		if(!isset($this->data['InventoryCount']['location_id'])) {
			//get location to start counting
			echo $this->Form->input('location_id',array('label'=>'Location to start counting'));
			echo $this->Form->end(__('Select Location')); 
		} else {
			//location id set
			echo $this->Form->input('location_id',array('label'=>'Location to start counting','type'=>'hidden'));
			echo $this->Html->link($locations[$this->data['InventoryCount']['location_id']],array('controller'=>'locations','action'=>'view',$this->data['InventoryCount']['location_id']));
		}//endif
	?>
	<h3>Items</h3>
	<table>
	<tr><th>Item</th><th>Count Qty</th></tr>
	<?php
// debug($locations);debug($this->data);debug($inventoryCount);
		if(isset($counts)) {
			//show existing counts
			foreach($counts as $item) {
				//loop for eachitem allready counted
				echo '<tr><td>'.$this->Html->link($item['Item']['name'],array('controller'=>'items','action'=>'view',$item['Item']['id'])).'</td>';
				echo '<td>'.$item['ItemCount']['qty'].'</td></tr>';
			}//end foreach
		}//endif
	?>
	</table>
	<?php
		if(isset($this->data['InventoryCount']['location_id'])) {
			//get new item
			echo $this->Form->input('item_id',array('after'=>$this->element('itemPopUp',array('inputId'=>'InventoryCountItemId'))));
			echo $this->Form->input('qty');
			echo $this->Form->end(__('Submit Count Qty')); 
		}
	?>
	</fieldset>
</div>
<?php if(isset($this->data['InventoryCount']['location_id'])): ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Finish Counting Location'), array('action' => 'finish', $inventoryCountsLocation_id)); ?> </li>
		<li><?php echo $this->Html->link(__('Count Another Location'), array('action' => 'count', $inventoryCount['InventoryCount']['id'])); ?> </li>
	</ul>
</div>
<?php endif; ?>