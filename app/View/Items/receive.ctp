<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Receive Item: ').$item['Item']['name'];?></legend>
	<?php
// debug($item);
		echo $this->Form->input('step',array('type'=>'hidden'));
		if($this->data['Item']['step']==1) {
			//step 1: get purchase order
			echo $this->Form->input('purchaseOrder_id');
			$submit='Select PO';
		} else {
			//show purchase order
			echo $this->Form->input('purchaseOrder_id',array('type'=>'hidden'));
			echo 'Purchase Order: ';
			echo $this->Html->link($purchaseOrder['PurchaseOrder']['id'],array('controller'=>'purchaseOrders','action'=>'view',$purchaseOrder['PurchaseOrder']['id']));
			echo '<br>Vendor: ';
			echo $this->Html->link($purchaseOrder['Vendor']['name'],array('controller'=>'vendors','action'=>'view',$purchaseOrder['Vendor']['id']));
		}//endif
		if($this->data['Item']['step']==2) {
			if($item['Item']['serialized']) echo $this->Form->input('qty',array('value'=>1,'disabled'=>true,'label'=>'Qty (1 for serialized item)'));
			else echo $this->Form->input('qty',array('id'=>'sc'));
			if(isset($this->data['Item']['cost'])) echo $this->Form->input('cost',array('disabled'=>true,'label'=>'Cost (Set on PO)'));
			else echo $this->Form->input('cost',array('id'=>'sc'));
			echo $this->Form->input('location_id');
			echo $this->Form->input('receiptType_id');
			if($item['Item']['serialized']) echo $this->Form->input('ItemSerialNumber.number',array('label'=>'Serial Number'));
			$submit='Submit';
		}//endif
// debug($this->data);
	?>
	<?php echo $this->Form->end(__($submit)); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>