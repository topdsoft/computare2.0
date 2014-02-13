<div class="vendors form">
<?php echo $this->Form->create('Vendor'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vendor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('VendorDetail.name',array('id'=>'sc'));
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
		echo $this->Html->link(__('Add Address'), array('controller'=>'addresses','action' => 'add','vendors', $this->data['Vendor']['id']));
		echo '</fieldset>';
		echo '<fieldset><legend>Contact Information</legend>';
		foreach ($this->data['Contact'] as $contact) {
			//loop for all contact info
			echo '<p><strong>'.$contact['field_name'].':</strong>';
			echo $contact['value'].' ';
			echo $this->Html->link(__('Edit'),array('controller'=>'contacts','action'=>'edit',$contact['id']));
			echo '&nbsp;&nbsp;&nbsp;';
			echo $this->Html->link(__('Delete'),array('controller'=>'contacts','action'=>'delete',$contact['id']),array(),__('Are you sure you want to delete this contact: '.$contact['field_name']));
			echo '</p>';
		}//end foreach
		echo $this->Html->link(__('Add Contact'), array('controller'=>'contacts','action' => 'add','vendors', $this->data['Vendor']['id']));
		echo '</fieldset>';
// 		echo $this->Form->input('active');
// 		echo $this->Form->input('Item');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>