<div class="salesOrders view">
<h2><?php  echo __('Sales Order: ').$salesOrder['SalesOrder']['id']; ?></h2>
	<dl>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sales Order Type'); ?></dt>
		<dd>
			<span title="<?php echo $salesOrder['SalesOrderType']['description']; ?>"> <?php echo $salesOrder['SalesOrderType']['name']; ?></span>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($salesOrder['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $salesOrder['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$salesOrder['SalesOrder']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($salesOrder['SalesOrder']['closed_id']): ?>
		<dt><?php echo __('Closed'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['closed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Closed By'); ?></dt>
		<dd>
			<?php echo $users[$salesOrder['SalesOrder']['closed_id']]; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<?php if($salesOrder['SalesOrder']['voided_id']): ?>
		<dt><?php echo __('Voided'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['voided']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Voided By'); ?></dt>
		<dd>
			<?php echo $users[$salesOrder['SalesOrder']['voided_id']]; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
	</dl>
	<?php echo $this->element('reportdetails'); ?>
	<table>
	<tr>
		<th>Description</th>
		<th>Units Ordered</th>
		<th>Units Shipped</th>
		<th>Merchandise Price</th>
		<th>Service Rate</th>
		<th>Total Merchandise</th>
		<th>Total Service</th>
		<th>Tax</th>
	</tr>
	<?php
		$productTotal=$serviceTotal=$taxTotal=0;
		
		foreach($salesOrder['ItemDetail'] as $item){
			//loop for all items in SO
			echo '<tr>';
			echo '<td>'.$this->Html->link($item['Item']['name'],array('controller'=>'items','action'=>'view',$item['Item']['id'])).'</td>';
			echo '<td>'.$item['qty'].'</td>';
			echo '<td>'.$item['shipped'].'</td>';
			echo '<td>'.$item['price'].'</td>';
			echo '<td></td><td>'.number_format($item['qty']*$item['price'],2).'</td>';
			$productTotal+=($item['qty']*$item['price']);
			echo '<td></td><td>'.$item['tax'].'</td>';
			$taxTotal+=$item['tax'];
			echo '</tr>';
		}//end foreach items
		//add line for shipping
		if($salesOrder['SalesOrder']['shipping_paid']) {
			//only show line if an amount is entered
			echo '<tr>';
			echo '<td>Shipping Paid</td><td></td><td></td><td></td><td>'.$salesOrder['SalesOrder']['shipping_paid'].'</td><td></td><td></td><td></td>';
			echo '</tr>';
		}//endif
		foreach($salesOrder['ServiceDetail'] as $service){
			//loop for all services in SO
			echo '<tr>';
			echo '<td>'.$service['Service']['name'];
			//check for details of time record
			if(isset($service['timeRecord_id'])){
				//show time record details
				echo ':<br><i>'.$service['TimeRecord']['created'].'</i><br>' .$service['TimeRecord']['notes'].'</td>';
			} else {
				//no time record
				echo '</td>';
			}//endif
			echo '<td>'.$service['qty'].'</td>';
			echo '<td></td><td></td><td>'.$service['price'];
			echo '<td></td><td>'.number_format($service['qty']*$service['price'],2).'</td>';
			$serviceTotal+=$service['qty']*$service['price'];
			echo '<td>'.$service['tax'].'</td>';
			$taxTotal+=$service['tax'];
			echo '</tr>';
		}//end foreach
		echo '<tr class="total"><th>Total</th><th></th><th></th><th></th><th></th><th>'.number_format($productTotal,2).'</th><th>'.number_format($serviceTotal,2).'</th><th>'.number_format($taxTotal,2).'</th></tr>';
		echo '<tr class="total"><th></th><th></th><th></th><th></th><th></th><th></th><th>Grand Total</th><th>'.number_format($productTotal+$serviceTotal+$taxTotal+$salesOrder['SalesOrder']['shipping_paid'],2).'</th></tr>';
		//show fees
		$feeTotal=0;
		if(isset($salesOrder['SalesOrderMod'])) {
			foreach($salesOrder['SalesOrderMod'] as $soMod) {
				//loop for all so mods and list them
				echo '<tr>';
				echo '<td>'.$soMod['label'].'</td>';
				echo '<td></td><td></td><td></td><td></td><td></td>';
				echo '<td>'.$soMod['amount'].'</td><td></td>';
				$feeTotal+=$soMod['amount'];
				echo '</tr>';
			}//end foreach
			echo '<tr class="total"><th>Fee Total</th><th></th><th></th><th></th><th></th><th></th><th>'.number_format($feeTotal,2).'</th><th></th></tr>';
		}//endif
		echo '<tr class="total"><th></th><th></th><th></th><th></th><th></th><th></th><th>Total After Fees</th><th>'.number_format($productTotal+$serviceTotal+$taxTotal+$salesOrder['SalesOrder']['shipping_paid']-$feeTotal,2).'</th></tr>';
	?>
	</table>
</div>
<?php 
//debug($salesOrder);?>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if($salesOrder['SalesOrder']['status']=='O') echo $this->Html->link(__('Edit Sales Order'), array('action' => 'edit', $salesOrder['SalesOrder']['id'])); ?> </li>
	</ul>
</div>
