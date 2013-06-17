<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrder'); ?>
	<fieldset>
		<legend><?php echo __('Complete Sales Order: ').$this->Form->value('SalesOrder.id'); ?></legend>
	<?php
// debug($this->data);
		echo "<p>Customer: ".$this->Html->link($this->data['Customer']['name'],array('controller'=>'customers','action'=>'view',$this->data['Customer']['id'])).'</p>';
		echo '<p>Sales Order Type: <strong title="'.$this->data['SalesOrderType']['description'].'">'.$this->data['SalesOrderType']['name'].'</strong></p>';
		echo '<h3>Merchandise</h3>';
		$productTotal=$qtyTotal=$taxTotal=$serviceTotal=0;
		if($this->data['ItemDetail']){
			//show items
			echo '<table><tr><th>Item</th><th>Qty</th><th>Price</th><th>Total</th><th>Tax</th></tr>';
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
			    echo '</tr>';
			}//endiforeach
			echo '<tr class="total"><th>Merchandise Total</th><th>'.$qtyTotal.'</th><th></th><th>'.number_format($productTotal,2).'</th><th></th></tr>';
			echo '</table>';
		}//endif
		echo '<h3>Services</h3>';
		if($this->data['ServiceDetail']) {
			//show services
			echo '<table><tr><th>Service</th><th>Qty</th><th>Rate</th><th>Total</th><th>Tax</th></tr>';
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
			    echo '</tr>';
			}//endiforeach
			echo '<tr class="total"><th>Service Total</th><th></th><th></th><th>'.number_format($serviceTotal,2).'</th><th></th></tr>';
			
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
	<?php 
		echo $this->Form->input('SalesOrderType.on_account',array('type'=>'hidden'));
		echo $this->Form->input('SalesOrderType.shipping',array('type'=>'hidden'));
		echo $this->Form->input('id');
		if($this->data['SalesOrderType']['shipping']) {
			//get shipping
			echo $this->Form->input('shipping');
		}//endif
		if($this->data['SalesOrderType']['on_account']) {
			//sale is on account
			echo '<p><strong>Sale will be on account.  Click Submit to invoice customer.</strong></p>';
			echo $this->Form->end(__('Submit'));
		} else {
			//sale is not on account
			if(isset($this->data['SalesOrder']['paymentType_id'])) {
				//payment type selected
				echo '<p>Payment Type:<strong>'.$paymentTypes[$this->data['SalesOrder']['paymentType_id']].'</strong></p>';
				echo $this->Form->input('paymentType_id',array('type'=>'hidden'));
				echo $this->Form->input('done',array('type'=>'hidden'));
// debug($paymentType);
				if($paymentType['PaymentType']['identification_label']) echo $this->Form->input('identification',array('label'=>$paymentType['PaymentType']['identification_label']));
				if($paymentType['PaymentType']['gl_expense_account_id']) echo $this->Form->input('expense',array('label'=>'Payment Expense'));
				echo $this->Form->end(__('Complete Sale')); 
			} else {
				//select payment type
				echo $this->Form->input('paymentType_id');
				echo $this->Form->end(__('Select Payment Type')); 
			}//endif
		}//ednif
// debug($this->data);
	?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('SalesOrderShipping').focus();</script>