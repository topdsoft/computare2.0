<div class="salesOrders view">
<h2><?php  echo __('Sales Order: ').$salesOrder['SalesOrder']['id']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Closed'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['closed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Closed Id'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['closed_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Voided'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['voided']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Voided Id'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['voided_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($salesOrder['SalesOrder']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sales Order Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($salesOrder['SalesOrderType']['name'], array('controller' => 'sales_order_types', 'action' => 'view', $salesOrder['SalesOrderType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($salesOrder['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $salesOrder['Customer']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php debug($salesOrder);?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sales Order'), array('action' => 'edit', $salesOrder['SalesOrder']['id'])); ?> </li>
	</ul>
</div>
