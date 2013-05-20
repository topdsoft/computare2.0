<div class="purchaseOrders form">
<?php echo $this->Form->create('PurchaseOrder'); ?>
	<fieldset>
		<legend><?php echo __('Receive Purchase Order: '),$this->data['PurchaseOrder']['id']; ?></legend>
	<?php
// debug($this->data);
		echo $this->Form->input('id');
		echo 'Vendor: '.$this->Html->link($this->data['Vendor']['name'],array('controller'=>'vendors','action'=>'view',$this->data['Vendor']['id']));
	?><br><br>

	<h3><?php echo __('Purchase Order Details'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Order Qty'); ?></th>
		<th><?php echo __('Rec to Date'); ?></th>
		<th><?php echo __('Qty to Receive'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
// debug($this->data);
		foreach ($this->data['PurchaseOrderDetail'] as $id=>$purchaseOrderDetail): ?>
		<tr>
			<td><?php echo $this->Html->link($items[$purchaseOrderDetail['item_id']],array('controller'=>'items','action'=>'view',$purchaseOrderDetail['item_id'])) ; ?></td>
			<td><?php echo $purchaseOrderDetail['qty']; ?></td>
			<td><?php echo $purchaseOrderDetail['rec']; ?></td>
			<td><?php 
				echo $this->Form->input('PurchaseOrderDetail.'.$id.'.id',array('type'=>'hidden')); 
				if($this->data['PurchaseOrder']['pass']==2) {
					//pass 2
					echo $this->Form->input('PurchaseOrderDetail.'.$id.'.recQty',array('label'=>'','disabled'=>true)); 
					echo $this->Form->input('PurchaseOrderDetail.'.$id.'.recQty',array('type'=>'hidden')); 
					if(isset($purchaseOrderDetail['serialized'])) {
						//show inputs for serial numbers
						for($i=0; $i<$purchaseOrderDetail['recQty']; $i++) {
							//loop for all inputs
							$inputOptions=array('label'=>'','type'=>'text');
							if($i==0) {
								//changes for first line
								$inputOptions['label']='Please Enter Serial Numbers';
								$inputOptions['id']='sc';
							}//endif
							echo $this->Form->input("PurchaseOrderDetail.$id.serialNumbers.$i",$inputOptions);
						}//end for i
					}//endif
				} else echo $this->Form->input('PurchaseOrderDetail.'.$id.'.recQty',array('label'=>'')); 
			?></td>
			<td><?php echo $purchaseOrderDetail['cost']; ?></td>
			<td class="actions">
				<?php //if($purchaseOrderDetail['rec']==0) echo $this->Html->link(__('Remove'), array('controller' => 'purchaseOrders', 'action' => 'removeline', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'purchase_order_details', 'action' => 'edit', $purchaseOrderDetail['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_order_details', 'action' => 'delete', $purchaseOrderDetail['id']), null, __('Are you sure you want to delete # %s?', $purchaseOrderDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php echo $this->Form->input('pass',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('shipping',array('id'=>'sc','type'=>'text')); ?>
	<?php echo $this->Form->input('tax',array('type'=>'text')); ?>
	<?php echo $this->Form->input('receiptType_id'); ?>
	<?php echo $this->Form->input('location_id',array('after'=>'TODO add location finder')); ?>

<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>
<?php echo $this->Html->script('formInputs.js'); ?>