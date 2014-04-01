<div class="customers view">
<h2><?php  echo __('Customer: '.$customer['Customer']['name']); ?></h2>
	<?php echo $this->element('reportdetails'); ?>
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
	<?php echo nl2br($customer['CustomerDetail']['notes']); ?>
&nbsp;</dd>
<?php
	if($customer['Address']) {
		//list addresses
		echo '<h3>Addresses</h3>';
		foreach ($customer['Address'] as $address) {
			//loop for all addresses
// 			echo '<dl>';
			echo '<h4>'.$address['name'].'</h4>';
			echo '<dt>'.__('Line1').'</dt>';
			echo '<dd>'.$address['line1'].'&nbsp;</dd>';
			echo '<dt>'.__('Line2').'</dt>';
			echo '<dd>'.$address['line2'].'&nbsp;</dd>';
			echo '<dt>'.__('City').'</dt>';
			echo '<dd>'.$address['city'].'&nbsp;</dd>';
			echo '<dt>'.__('State').'</dt>';
			echo '<dd>'.$address['state'].'&nbsp;</dd>';
			echo '<dt>'.__('Zip').'</dt>';
			echo '<dd>'.$address['zip'].'&nbsp;</dd>';
// 			echo '</dl>';
		}//foreach
	}//enidf
?>
<?php
	if($customer['Contact']) {
		//list contacts
		echo '<h3>Contact Information</h3>';
		foreach ($customer['Contact'] as $contact) {
			//loop for all contacts
			echo '<dt>'.$contact['field_name'].'</dt>';
			if($contact['field_name']=='Website') {
				//if website show as link
				if(!strpos($contact['value'],'http://')) echo '<dd><a href="http://'.$contact['value'].'">'.$contact['value'].'</a>&nbsp;</dd>';
				else echo '<dd><a href="'.$contact['value'].'">'.$contact['value'].'</a>&nbsp;</dd>';
			} else echo '<dd>'.$contact['value'].'&nbsp;</dd>';
		}//end foreach
	}//endif
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
	</ul>
</div>
	
<div class="related">
	<?php if(!empty($customer['Sales'])): ?>
	<h3><?php echo __('Sales'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item'); ?></th>
		<th><?php echo __('Service'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('By'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Shipped'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('SO'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customer['Sales'] as $sale): ?>
		<tr>
			<td><?php if($sale['Item']) echo $this->Html->link($sale['Item']['name'],array('controller'=>'items','action'=>'view',$sale['item_id'])) ; ?></td>
			<td><?php if($sale['Service']) echo $this->Html->link($sale['Service']['name'],array('controller'=>'services','action'=>'view',$sale['service_id'])) ; ?></td>
			<td><?php echo $sale['created']; ?></td>
			<td><?php echo $users[$sale['created_id']]; ?></td>
			<td><?php echo $sale['SalesOrderDetail']['qty']; ?></td>
			<td><?php echo $sale['SalesOrderDetail']['shipped']; ?></td>
			<td><?php echo $sale['SalesOrderDetail']['price']; ?></td>
			<td><?php echo $this->Html->link($sale['SalesOrderDetail']['salesOrder_id'],array('controller'=>'salesOrders','action'=>'view',$sale['SalesOrderDetail']['salesOrder_id'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
		
	<?php endif; ?>
</div>
<?php //debug($customer);
	echo $this->element('revisionblock',array('data'=>$customer,'ignore'=>array('id','created','created_id')));
?></dl>
</div><br>
<?php echo $this->Html->script('sliderelated.js') ?>