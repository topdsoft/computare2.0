<div class="inventoryCounts form">
<?php echo $this->Form->create('InventoryCount'); ?>
	<fieldset>
		<legend><?php echo __('Edit Inventory Count'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('notes');
	?>
	<h3>Locations</h3>
	<table>
	<?php
// debug($this->data);
		foreach($this->data['Location'] as $location) {
			//loop for all locations
			echo '<tr><td>'.$this->Html->link($location['name'],array('controller'=>'locations','action'=>'view',$location['id'])).'</td></tr>';
		}//end foreach
	?>
	</table>
	<?php 
		echo $this->Form->input('location_id',array('label'=>'Location (will include all child locations)'));
		echo $this->Form->end(__('Add Location')); 
	?>
	</fieldset>
</div>
