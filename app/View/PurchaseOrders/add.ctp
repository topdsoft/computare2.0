<div class="purchaseOrders form">
<?php echo $this->Form->create('PurchaseOrder'); ?>
	<fieldset>
		<legend><?php echo __('Add Purchase Order'); ?></legend>
	<?php
		echo $this->Form->input('vendor_id',array('id'=>'sc'));
		echo $this->Form->input('allowOpen');
		echo $this->Form->input('onAccount');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Vendor'), array('controller'=>'vendors','action' => 'add','redirect'=>array('controller'=>'purchaseOrders','action'=>'add','id'=>'NEW'))); ?></li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>