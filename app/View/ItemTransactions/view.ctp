<div class="itemTransactions view">
<h2><?php  echo __('Item Transaction'); ?></h2>
	<dl>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemTransaction['Item']['name'], array('controller' => 'items', 'action' => 'view', $itemTransaction['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemTransaction['Location']['name'], array('controller' => 'locations', 'action' => 'view', $itemTransaction['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd>
			<?php echo h($itemTransaction['ItemTransaction']['qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($itemTransaction['ItemTransaction']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itemTransaction['ItemTransaction']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$itemTransaction['ItemTransaction']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($itemTransaction['Sale']['id']): ?>
			<dt><?php echo __('Sale'); ?></dt>
			<dd>
				<?php echo $this->Html->link($itemTransaction['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $itemTransaction['Sale']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($itemTransaction['Receipt']['id']): ?>
			<dt><?php echo __('Purchase Order'); ?></dt>
			<dd>
				<?php echo $this->Html->link($itemTransaction['Receipt']['purchaseOrder_id'], array('controller' => 'purchaseOrders', 'action' => 'view', $itemTransaction['Receipt']['purchaseOrder_id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
	</dl>
</div>
<?php //debug($itemTransaction);?>