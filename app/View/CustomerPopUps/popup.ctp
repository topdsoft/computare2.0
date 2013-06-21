<?php echo $this->Form->create('Customer'); ?>
<?php
	echo $this->Html->css('cake.generic');
// debug($customers);
?>
<fieldset><legend>Customer Search</legend>
<?php
	echo $this->Form->input('lastName',array('id'=>'sc'));
	echo $this->Form->input('firstName');
	echo $this->Form->input('companyName',array('label'=>'Company'));
	
	echo $this->Form->end(__('Find'));
?>
</fieldset>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('CustomerDetail.companyName','Company'); ?></th>
			<th><?php echo $this->Paginator->sort('CustomerDetail.lastName','Last Name'); ?></th>
			<th><?php echo $this->Paginator->sort('CustomerDetail.firstName','First Name'); ?></th>
	</tr>
	<?php 
	foreach ($customers as $customer): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link(__('Select'), '#', array('onclick' => 'select("'.$customer['Customer']['id'].'")')); ?>
		</td>
		<td><?php echo h($customer['CustomerDetail']['companyName']); ?>&nbsp;</td>
		<td><?php echo h($customer['CustomerDetail']['lastName']); ?>&nbsp;</td>
		<td><?php echo h($customer['CustomerDetail']['firstName']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

<script type='text/javascript'>document.getElementById('sc').focus();</script>
	<script type='text/javascript'>

		function select(id) {
			//user has selected an customer, return to previous form
			opener.document.getElementById('<?php echo $this->request->params['named']['inputId']; ?>').value=id;
			alert(id);
			self.close();
		}
		
	</script>