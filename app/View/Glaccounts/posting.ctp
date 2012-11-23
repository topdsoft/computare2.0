<div class="glaccounts posting">
<?php echo $this->Form->create('Glaccount'); ?>
	<h2><?php echo __('General Ledger Posting'); ?></h2>
	<table>
	<tr><th>Debit</th><th>Credit</th></tr>
	<tr>
		<td><table>
		<tr><th>Account</th><th>Amount</th><th></th></tr>
		<?php
			if(isset($this->passedArgs['debit'])) {
				foreach($this->passedArgs['debit'] as $i => $debitaccount) {
					//show each debit
					echo'<tr>';
					echo'<td>'.$glaccountlist[$debitaccount].'</td>';
					echo'<td>'.$this->Form->input('debit.'.$debitaccount,array('label'=>'','type'=>'text','class'=>'debit')).'</td>';
					echo'<td class="actions">'.$this->Html->link(__('Remove'), array_merge($this->passedArgs,array('remdebit'=>$i))).'</td>';
					echo'</tr>';
				}//endforeach
			}//endif
		?>
		<tr><th>Debit Total</th><th><span id="dt">0.00</span></th><th></th></tr>
		</table></td>
		<td><table>
		<tr><th>Account</th><th>Amount</th><th></th></tr>
		<?php
			if(isset($this->passedArgs['credit'])) {
				foreach($this->passedArgs['credit'] as $i=>$creditaccount) {
					//show each credit
					echo'<tr>';
					echo'<td>'.$glaccountlist[$creditaccount].'</td>';
					echo'<td>'.$this->Form->input('credit.'.$creditaccount,array('label'=>'','type'=>'text','class'=>'credit')).'</td>';
					echo'<td class="actions">'.$this->Html->link(__('Remove'), array_merge($this->passedArgs,array('remcredit'=>$i))).'</td>';
					echo'</tr>';
				}//endforeach
			}//endif
		?>
		<tr><th>Credit Total</th><th><span id="ct">0.00</span></th><th></th></tr>
		</table></td>
	</tr>
	</table>
	<?php
		echo $this->Form->input('Glnote.text',array('label'=>'Notes (optional)'));
		echo $this->Form->input('Glcheck.checkNumber',array('label'=>'Check Number (optional)'));
		echo $this->Form->input('Glentry.postDate',array('label'=>'Posting Date (if different)'));
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('group'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th>Select Accounts:</th>
	</tr>
	<?php 
	foreach ($glaccounts as $glaccount): ?>
	<tr>
		<td><?php echo h($glaccount['Glaccount']['group']); ?>&nbsp;</td>
		<td><?php echo h($glaccount['Glaccount']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Debit'), array_merge($this->passedArgs,array('adddebit'=>$glaccount['Glaccount']['id']))); ?>
			<?php echo $this->Html->link(__('Credit'), array_merge($this->passedArgs,array('addcredit'=>$glaccount['Glaccount']['id']))); ?>
		</td>
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
</div>
<script type='text/javascript'>
	function formatCurrency(num) {
		num = isNaN(num) || num === '' || num === null ? 0.00 : num;
		return parseFloat(num).toFixed(2);
	}
	function calctotals(){
		//calculate the totals for debit and credit
		var tdebit=0.00;
		$('.debit').each(function(){tdebit+=parseFloat(formatCurrency($(this).val()));});
		$('#dt').text(formatCurrency(tdebit));
		var tcredit=0.00;
		$('.credit').each(function(){tcredit+=parseFloat(formatCurrency($(this).val()));});
		$('#ct').text(formatCurrency(tcredit));
		//hide or show the submit button
		if(tdebit==tcredit && tdebit!=0.00) $(".submit").show();
		else $(".submit").hide();
	}
	$(".submit").hide();

	$('.debit').blur(function(){
		//check debit entries
		var debit=$(this).val();
		if(debit<0)debit*=-1;
		$(this).val(formatCurrency(debit));
		calctotals();
	});
	
	$('.credit').blur(function(){
		//check credit entries
		var credit=$(this).val();
		if(credit<0)credit*=-1;
		$(this).val(formatCurrency(credit));
		calctotals();
	});

</script>
