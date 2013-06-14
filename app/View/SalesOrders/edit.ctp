<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrder'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sales Order: ').$this->Form->value('SalesOrder.id'); ?></legend>
	<?php
// debug($this->data);
		echo "<p>Customer: ".$this->Html->link($this->data['Customer']['name'],array('controller'=>'customers','action'=>'view',$this->data['Customer']['id'])).'</p>';
		echo '<p>Sales Order Type: <strong title="'.$this->data['SalesOrderType']['description'].'">'.$this->data['SalesOrderType']['name'].'</strong></p>';
		echo '<h3>Merchandise</h3>';
		$productTotal=$qtyTotal=$taxTotal=$serviceTotal=0;
		if($this->data['ItemDetail']){
			//show items
			echo '<table><tr><th>Item</th><th>Qty</th><th>Price</th><th>Total</th><th>Tax</th><th></th></tr>';
			foreach($this->data['ItemDetail'] as $detail) {
			    //loop for all item details
			    echo '<tr>';
			    echo '<td>'.$items[$detail['item_id']].'</td>';
			    echo '<td>'.$detail['qty'].'</td>';
			    $qtyTotal+=$detail['qty'];
			    echo '<td>'.$detail['price'].'</td>';
			    $productTotal+=$detail['price']*$detail['qty'];
			    echo '<td>'.number_format($detail['price']*$detail['qty'],2).'</td>';
			    echo '<td>'.$detail['tax'].'</td>';
			    $taxTotal+=$detail['tax'];
				echo '<td class="actions">';
					echo $this->Html->link(__('Remove'), array('action' => 'removeline', $detail['id']),null, 'Are you sure you want to remove product: '.$items[$detail['item_id']].' ?');
				echo '</td>';
			    echo '</tr>';
			}//endiforeach
			echo '<tr class="total"><th>Merchandise Total</th><th>'.$qtyTotal.'</th><th></th><th>'.number_format($productTotal,2).'</th><th></th><th></th></tr>';
			echo '</table>';
		}//endif
		echo '<h3>Services</h3>';
		if($this->data['ServiceDetail']) {
			//show services
			echo '<table><tr><th>Service</th><th>Qty</th><th>Rate</th><th>Total</th><th>Tax</th><th></th></tr>';
			foreach($this->data['ServiceDetail'] as $detail) {
			    //loop for all service details
// debug($detail);
			    echo '<tr>';
			    echo '<td>'.$services[$detail['service_id']].'</td>';
			    if($servicesPricing[$detail['service_id']]=='U') echo '<td>'.intval($detail['qty']);
			    else echo '<td>'.$detail['qty'];
				if($servicesPricing[$detail['service_id']]=='H') echo ' hrs';
				else echo ' each';
				echo '</td>';
			    echo '<td>'.$detail['price'].'</td>';
			    echo '<td>'.number_format($detail['price']*$detail['qty'],2).'</td>';
			    $serviceTotal+=($detail['price']*$detail['qty']);
			    echo '<td>'.$detail['tax'].'</td>';
			    $taxTotal+=$detail['tax'];
				echo '<td class="actions">';
					echo $this->Html->link(__('Remove'), array('action' => 'removeline', $detail['id']),null, 'Are you sure you want to remove service: '.$services[$detail['service_id']].' ?');
				echo '</td>';
			    echo '</tr>';
			}//endiforeach
			echo '<tr class="total"><th>Service Total</th><th></th><th></th><th>'.number_format($serviceTotal,2).'</th><th></th><th></th></tr>';
			
			echo '</table>';
		}//endif
	?>
	<h3>Total</h3>
	<table style="width:50%;">
	<tr><td>Merchandise Sub total</td><td><?php echo number_format($productTotal,2); ?></td></tr>
	<tr><td>Service Sub total</td><td><?php echo number_format($serviceTotal,2); ?></td></tr>
	<tr><td>Tax Sub total</td><td><?php echo number_format($taxTotal,2); ?></td></tr>
	<tr class="total"><th>Grand Total</th><th><?php echo number_format($productTotal+$serviceTotal+$taxTotal,2); ?></th></tr>
	</table>
	<?php echo $this->Form->end(__('Done')); ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Product Line'), array('action' => 'addproduct',$this->Form->value('SalesOrder.id'))); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Line'), array('action' => 'addservice',$this->Form->value('SalesOrder.id'))); ?> </li>
	</ul>
</div>
