<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrder'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sales Order: ').$this->Form->value('SalesOrder.id'); ?></legend>
	<?php
// debug($this->data);
		echo "<p>Customer: ".$this->Html->link($this->data['Customer']['name'],array('controller'=>'customers','action'=>'view',$this->data['Customer']['id'])).'</p>';
		echo '<p>Sales Order Type: <strong title="'.$this->data['SalesOrderType']['description'].'">'.$this->data['SalesOrderType']['name'].'</strong></p>';
		echo '<h3>Merchandise</h3>';
		if($this->data['ItemDetail']){
			//show items
			echo '<table><tr><th>Item</th><th>Qty</th><th></th></tr>';
			foreach($this->data['ItemDetail'] as $detail) {
			    //loop for all item details
			    echo '<tr>';
			    echo '<td>'.$items[$detail['item_id']].'</td>';
			    echo '<td>'.$detail['qty'].'</td>';
				echo '<td class="actions">';
					echo $this->Html->link(__('Remove'), array('action' => 'removeline', $detail['id']));
				echo '</td>';
			    echo '</tr>';
			}//endiforeach
			
			echo '</table>';
		}//endif
		echo '<h3>Services</h3>';
	?>
	</fieldset>
<?php echo $this->Form->end(__('Done')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Product Line'), array('action' => 'addproduct',$this->Form->value('SalesOrder.id'))); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Line'), array('action' => 'addservice',$this->Form->value('SalesOrder.id'))); ?> </li>
	</ul>
</div>
