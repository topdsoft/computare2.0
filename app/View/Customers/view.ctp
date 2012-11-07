<div class="customers view">
<h2><?php  echo __('Customer: '.$customer['Customer']['name']); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo str_pad($customer['Customer']['id'],10,'0',STR_PAD_LEFT); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo __($customer['Customer']['active'] ? 'Active' : 'DELETED'); ?>
			&nbsp;
		</dd>
		<?php if(!$customer['Customer']['active']): ?>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo $customer['Customer']['modified']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted By'); ?></dt>
		<dd>
			<?php echo $users[$customer['Customer']['deleted_id']]; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo $customer['Customer']['created']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$customer['Customer']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
	<?php echo $users[$customer['CustomerDetail']['created_id']]; ?>
&nbsp;</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['companyName']; ?>
&nbsp;</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['firstName']; ?>
&nbsp;</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['lastName']; ?>
&nbsp;</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['address1']; ?>
&nbsp;</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['address2']; ?>
&nbsp;</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['city']; ?>
&nbsp;</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['state']; ?>
&nbsp;</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['zip']; ?>
&nbsp;</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['email']; ?>
&nbsp;</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['phone']; ?>
&nbsp;</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
	<?php echo $customer['CustomerDetail']['notes']; ?>
&nbsp;</dd>
	</dl>
<?php //debug($customer);
	if(count($customer['Revisions'])>1) {
		//show revisions
		$ignore=array('id','created','created_id');
		echo'<br><h3>Revisions</h3>';
		foreach($customer['Revisions'] as $i=>$revision) {
			//loop for each revision
			if($i>0) {
				//skip first revision since it is the current data
				echo "<p>Made: {$revision['created']} by: ".$users[$revision['created_id']].'</p>';
				echo '<dl>';
				foreach($revision as $label=>$value) {
					//loop for all label => value pair and check for differences
					if(!in_array($label,$ignore) && $value!=$customer['Revisions'][$i-1][$label]) {
						//show difference
						$newValue=$customer['Revisions'][$i-1][$label];
						if(empty($value)) $value='<i>(empty)</i>';
						if(empty($newValue)) $newValue='<i>(empty)</i>';
						echo "<dt>$label from</dt><dd>$value</dd>";
						echo "<dt>$label to</dt><dd>$newValue</dd>";
					}//endif
				}//end foreach $revision
				echo '</dl><br>';
			}//endif
		}//endforeach $customer['Revisions']
	}//endif
?>
</div><br>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Customer'), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
		<li><?php //echo $this->Html->link(__('List Customers'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Customer Details'), array('controller' => 'customer_details', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Customer Detail'), array('controller' => 'customer_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
	