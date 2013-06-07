<div class="stockLevels form">
<?php echo $this->Form->create('StockLevel'); ?>
	<fieldset>
		<legend><?php echo __('Edit Stock Level'); ?></legend>
	<?php
		echo '<p><strong>Location:</strong>'.$this->Html->link($locationName,array('controller'=>'locations','action'=>'view',$current['ItemsLocation']['location_id'])).'</p>';
		echo '<p><strong>Item:</strong>'.$this->Html->link($itemName,array('controller'=>'items','action'=>'view',$current['ItemsLocation']['item_id'])).'</p>';
		echo '<p><strong>Current Qty:</strong>'.$current['ItemsLocation']['qty'].'</p>';
		echo $this->Form->input('id');
		echo $this->Form->input('qty');
		echo $this->Form->input('priority');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php  
// debug($current); ?>
</div>
<script type='text/javascript'>document.getElementById('StockLevelQty').focus();</script>