<div class="salesOrders view">
<h2><?php  echo __('Sales Order'); ?></h2>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sales Order'), array('action' => 'edit', $salesOrder['SalesOrder']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sales Order'), array('action' => 'delete', $salesOrder['SalesOrder']['id']), null, __('Are you sure you want to delete # %s?', $salesOrder['SalesOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Order Types'), array('controller' => 'sales_order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Order Type'), array('controller' => 'sales_order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
