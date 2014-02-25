<div class="salesOrderTypes form">
<?php echo $this->Form->create('SalesOrderType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sales Order Type: ').$this->data['SalesOrderType']['name']; ?></legend>
	<?php //debug($this->data);
		echo $this->Form->input('id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('action');
		echo $this->Form->input('description',array('label'=>'Description (optional)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
	<br>
	<?php if($this->data['SalesOrderFee']): ?>
		<fieldset><legend><?php echo __('Sales Order Fees') ?></legend>
			<table>
				<tr><th>Label</th><th>Debit Account</th><th>Credit Account</th><th>Created</th><th>By</th></tr>
				<?php
				foreach($this->data['SalesOrderFee'] as $fee) {
					//loop to display all fees for this dales order type
					echo '<tr>';
					echo '<td>'.$fee['label'].'</td>';
					echo '<td>'.$glaccounts[$fee['debitAccount_id']].'</td>';
					echo '<td>'.$glaccounts[$fee['creditAccount_id']].'</td>';
					echo '<td>'.$fee['created'].'</td>';
					echo '<td>'.$users[$fee['created_id']].'</td>';
					echo '</tr>';
				}//end foreach
				?>
			</table>
		</fieldset>
	<?php endif; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add Sales Order Fee'), array('controller'=>'salesOrderFees','action' => 'add',$this->data['SalesOrderType']['id'])); ?></li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('SalesOrderTypeDescription').focus();</script>