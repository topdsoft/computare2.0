<div class="salesOrderTypes view">
<h2><?php  echo __('Sales Order Type: ').$salesOrderType['SalesOrderType']['name']; ?></h2>
<?php //debug($salesOrderType);?>
	<dl>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($salesOrderType['SalesOrderType']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($salesOrderType['SalesOrderType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$salesOrderType['SalesOrderType']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($salesOrderType['SalesOrderType']['removed']): ?>
		<dt><?php echo __('Removed'); ?></dt>
		<dd>
			<?php echo h($salesOrderType['SalesOrderType']['removed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed By'); ?></dt>
		<dd>
			<?php echo $users[$salesOrderType['SalesOrderType']['removed_id']]; ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo $this->Html->link($salesOrderType['SalesOrderType']['action'],array('controller'=>'salesOrders','action'=>$salesOrderType['SalesOrderType']['action'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Due Days'); ?></dt>
		<dd>
			<?php echo h($salesOrderType['SalesOrderType']['due_days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping'); ?></dt>
		<dd>
			<?php if($salesOrderType['SalesOrderType']['shipping']) echo 'Y'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Taxable'); ?></dt>
		<dd>
			<?php if($salesOrderType['SalesOrderType']['taxable']) echo 'Y'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('On Account'); ?></dt>
		<dd>
			<?php if($salesOrderType['SalesOrderType']['on_account']) echo 'Y'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stock Required'); ?></dt>
		<dd>
			<?php if($salesOrderType['SalesOrderType']['stock_required']) echo 'Y'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stock Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($salesOrderType['Location']['name'],array('controller'=>'locations','action'=>'view',$salesOrderType['SalesOrderType']['location_id'])); ?>
			&nbsp;
		</dd>
	</dl>
	<?php echo $this->element('reportdetails'); ?>
<div class="related">
	<h3>GL Accounts</h3>
	<table>
	<tr>
		<th>Amount</th>
		<th>Debit Account</th>
		<th>Credit Account</th>
	</tr>
	<tr>
		<td>Item Total</td>
		<td><?php if($salesOrderType['SalesOrderType']['itemTotalDebitAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['itemTotalDebitAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['itemTotalDebitAcct_id'])) ?></td>
		<td><?php if($salesOrderType['SalesOrderType']['itemTotalCreditAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['itemTotalCreditAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['itemTotalCreditAcct_id'])) ?></td>
	</tr>
	<tr>
		<td>Service Total</td>
		<td><?php if($salesOrderType['SalesOrderType']['serviceTotalDebitAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['serviceTotalDebitAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['serviceTotalDebitAcct_id'])) ?></td>
		<td><?php if($salesOrderType['SalesOrderType']['serviceTotalCreditAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['serviceTotalCreditAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['serviceTotalCreditAcct_id'])) ?></td>
	</tr>
	<tr>
		<td>Shipping</td>
		<td><?php if($salesOrderType['SalesOrderType']['shippingDebitAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['shippingDebitAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['shippingDebitAcct_id'])) ?></td>
		<td><?php if($salesOrderType['SalesOrderType']['shippingCreditAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['shippingCreditAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['shippingCreditAcct_id'])) ?></td>
	</tr>
	<tr>
		<td>Tax</td>
		<td><?php if($salesOrderType['SalesOrderType']['taxDebitAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['taxDebitAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['taxDebitAcct_id'])) ?></td>
		<td><?php if($salesOrderType['SalesOrderType']['taxCreditAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['taxCreditAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['taxCreditAcct_id'])) ?></td>
	</tr>
	<tr>
		<td>Grand Total</td>
		<td><?php if($salesOrderType['SalesOrderType']['grandTotalDebitAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['grandTotalDebitAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['grandTotalDebitAcct_id'])) ?></td>
		<td><?php if($salesOrderType['SalesOrderType']['grandTotalCreditAcct_id']) echo $this->Html->link($glaccounts[$salesOrderType['SalesOrderType']['grandTotalCreditAcct_id']],array('controller'=>'glaccounts','action'=>'view',$salesOrderType['SalesOrderType']['grandTotalCreditAcct_id'])) ?></td>
	</tr>
	</table>
</div>
</div>
<?php 
// debug($salesOrder);?>
<?php echo $this->Html->script('sliderelated.js') ?>