<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Customer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('CustomerDetail.customer_id',array('type'=>'hidden'));
		echo $this->Form->input('CustomerDetail.companyName');
		echo $this->Form->input('CustomerDetail.firstName');
		echo $this->Form->input('CustomerDetail.lastName');
		echo $this->Form->input('CustomerDetail.address1');
		echo $this->Form->input('CustomerDetail.address2');
		echo $this->Form->input('CustomerDetail.city');
		echo $this->Form->input('CustomerDetail.state');
		echo $this->Form->input('CustomerDetail.zip');
		echo $this->Form->input('CustomerDetail.email');
		echo $this->Form->input('CustomerDetail.phone');
		echo $this->Form->input('CustomerDetail.notes');
//		echo $this->Form->input('customerDetail_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Customer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Customer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customer Details'), array('controller' => 'customer_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer Detail'), array('controller' => 'customer_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
