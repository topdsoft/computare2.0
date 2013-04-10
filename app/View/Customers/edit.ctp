<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Customer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('CustomerDetail.customer_id',array('type'=>'hidden'));
		echo $this->Form->input('CustomerDetail.companyName',array('id'=>'sc'));
		echo $this->Form->input('CustomerDetail.firstName');
		echo $this->Form->input('CustomerDetail.lastName');
// 		echo $this->Form->input('CustomerDetail.address1');
// 		echo $this->Form->input('CustomerDetail.address2');
// 		echo $this->Form->input('CustomerDetail.city');
// 		echo $this->Form->input('CustomerDetail.state');
// 		echo $this->Form->input('CustomerDetail.zip');
		echo '<fieldset><legend>Address</legend>';
		foreach ($this->data['Address'] as $address) {
			//loop for all addresses
// debug($address);
			echo '<p>';
			echo '<strong>'.$address['name'].'</strong> ';
			echo $this->Html->link(__('Edit'),array('controller'=>'addresses','action'=>'edit',$address['id']));
			echo '&nbsp;&nbsp;&nbsp;';
			echo $this->Html->link(__('Delete'),array('controller'=>'addresses','action'=>'delete',$address['id']),
				array(),__('Are you sure you want to delete this address: '.$address['name']));
			echo '</br>';
			echo $address['line1'].'<br>';
			if($address['line2']) echo $address['line2'].'<br>';
			echo $address['city'].','.$address['state'].' '.$address['zip'].'<br>';
			echo '</p>';
		}//end foreach
		echo $this->Html->link(__('Add Address'), array('controller'=>'addresses','action' => 'add','customers', $this->data['Customer']['id']));
		echo '</fieldset>';

		echo $this->Form->input('CustomerDetail.email');
		echo $this->Form->input('CustomerDetail.phone');
		echo $this->Form->input('CustomerDetail.notes');
//		echo $this->Form->input('customerDetail_id');
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>