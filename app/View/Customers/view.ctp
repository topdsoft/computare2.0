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
<?php //debug($customer);
	echo $this->element('revisionblock',array('data'=>$customer,'ignore'=>array('id','created','created_id')));
?></dl>
</div><br>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Customer'), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
	</ul>
</div>
	