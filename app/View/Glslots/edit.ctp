<div class="glslots form">
<?php echo $this->Form->create('Glslot'); ?>
	<fieldset>
		<legend><?php echo __('Edit GL Account Conections'); ?></legend>
	<table>
	<tr><th>Slot</th><th>Debit Account</th><th>Credit Account</th></tr>
	<?php
		//receive inventory
		echo '<tr><th colspan="3">Receive Inventory</th></tr>';
		echo '<tr><td title="Total amount owed on invoice">Accounts Payable <br>(default if no vendor account)</td>';
		echo '<td>'.$this->Form->input('recAPdebit',array('label'=>'','type'=>'select','options'=>$glaccounts,'disabled'=>true)).'</td>';
		echo '<td>'.$this->Form->input('recAPcredit',array('label'=>'','type'=>'select','options'=>$glaccounts,'after'=>' <span title="This account will be overridden by the vendors GL account">Note</span>')).'</td>';
		echo '</tr>';
		echo '<tr><td title="Only cost of the merchandise or service">Inventory Assets</td>';
		echo '<td>'.$this->Form->input('recInvdebit',array('label'=>'','type'=>'select','options'=>$glaccounts,'after'=>' <span title="This account will be overridden by the receipt type GL account">Note</span>')).'</td>';
		echo '<td>'.$this->Form->input('recInvcredit',array('label'=>'','type'=>'select','options'=>$glaccounts,'disabled'=>true)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Only shipping cots">Shipping</td>';
		echo '<td>'.$this->Form->input('recShipdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('recShipcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Only taxes owed">Tax</td>';
		echo '<td>'.$this->Form->input('recTaxdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('recTaxcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		
		//pay invoice
		echo '<tr><th colspan="3">Pay Invoice</th></tr>';
		echo '<tr><td title="Total amount owed on invoice minus interest">Accounts Payable <br>(default if no vendor account)</td>';
		echo '<td>'.$this->Form->input('payAPdebit',array('label'=>'','type'=>'select','options'=>$glaccounts,'after'=>' <span title="This account will be overridden by the vendors GL account">Note</span>')).'</td>';
		echo '<td>'.$this->Form->input('payAPcredit',array('label'=>'','type'=>'select','options'=>$glaccounts,'disabled'=>true)).'</td>';
		echo '</tr>';
		echo '<tr><td title="If there is interest to be paid on invoice">Interest</td>';
		echo '<td>'.$this->Form->input('payIntdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('payIntcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Total amount owed on invoice">Cash</td>';
		echo '<td>'.$this->Form->input('payCashdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('payCashcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		
		//issue inventory
		echo '<tr><th colspan="3">Issue Inventory</th></tr>';
		echo '<tr><td title="Cost of the inventory issued">Cost of Inventory <br>(default if no issue account)</td>';
		echo '<td>'.$this->Form->input('issuedebitDef',array('label'=>'','type'=>'select','options'=>$glaccounts,'after'=>' <span title="This account will be overridden by the issue type GL account">Note</span>')).'</td>';
		echo '<td>'.$this->Form->input('issuecreditDef',array('label'=>'','type'=>'select','options'=>$glaccounts,'disabled'=>true)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Cost of the inventory issued">Cost of Inventory <br>(never overridden)</td>';
		echo '<td>'.$this->Form->input('issuedebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('issuecredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		
		//sale on account
		echo '<tr><th colspan="3">Sale on Account</th></tr>';
		echo '<tr><td title="Merchandise+Service+Tax+Shipping">Total Amount <br>(default if no AR account for customer)</td>';
		echo '<td>'.$this->Form->input('saletotaldebit',array('label'=>'','type'=>'select','options'=>$glaccounts,'after'=>' <span title="This account will be overridden by customers AR account">Note</span>')).'</td>';
		echo '<td>'.$this->Form->input('saletotalcredit',array('label'=>'','type'=>'select','options'=>$glaccounts,'disabled'=>true)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Just merchandise and service">Merchandise & Service</td>';
		echo '<td>'.$this->Form->input('saleamountdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('saleamountcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Just tax amount">Tax</td>';
		echo '<td>'.$this->Form->input('saletaxdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('saletaxcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Just shipping">Shipping</td>';
		echo '<td>'.$this->Form->input('saleshippingdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('saleshippingcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Amount paid by customer">Customer Payment <br>(default if no AR account for customer)</td>';
		echo '<td>'.$this->Form->input('salepaymentdebitDefault',array('label'=>'','type'=>'select','options'=>$glaccounts,'disabled'=>true)).'</td>';
		echo '<td>'.$this->Form->input('salepaymentcreditDefault',array('label'=>'','type'=>'select','options'=>$glaccounts,'after'=>' <span title="This account will be overridden by customers AR account">Note</span>')).'</td>';
		echo '</tr>';
		echo '<tr><td title="Amount paid by customer. This account is never replaced by the customers account">Customer Payment <br>(Never overridden)</td>';
		echo '<td>'.$this->Form->input('salepaymentdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('salepaymnetcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		
		//cash sale
		echo '<tr><th colspan="3">Cash Sale</th></tr>';
		echo '<tr><td title="Merchandise+Services+Tax">Total Amount</td>';
		echo '<td>'.$this->Form->input('cashsaletotaldebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('cashsaletotalcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Just merchandise and service">Merchandise & Service</td>';
		echo '<td>'.$this->Form->input('cashsalemerchdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('cashsalemerchcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		echo '<tr><td title="Just tax amount">Tax</td>';
		echo '<td>'.$this->Form->input('cashsaletaxdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('cashsaletaxcredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
		
		//all sales
		echo '<tr><th colspan="3">All Sales</th></tr>';
		echo '<tr><td title="Total cost of items sold">Cost of Goods Sold</td>';
		echo '<td>'.$this->Form->input('cogsdebit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '<td>'.$this->Form->input('cogscredit',array('label'=>'','type'=>'select','options'=>$glaccounts)).'</td>';
		echo '</tr>';
	?>
	</table>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<?php
// debug($glaccounts);?>
<script type='text/javascript'>//<!--
$(function(){
	$("select").change( function(){
		$(this).attr('style','background:#ffcc00');
	});
})


//--></script>