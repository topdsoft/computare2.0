<div class="inventoryLocks view">
<h2><?php  echo __('Inventory Lock'); ?></h2>
	<dl>
		<dt><?php echo __('Locked'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo $users[$inventoryLock['InventoryLock']['created_id']]; ?>
			&nbsp;
		</dd>
		<?php if($inventoryLock['InventoryLock']['removed']): ?>
			<dt><?php echo __('Removed'); ?></dt>
			<dd>
				<?php echo h($inventoryLock['InventoryLock']['removed']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('By'); ?></dt>
			<dd>
				<?php echo $users[$inventoryLock['InventoryLock']['removed_id']]; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo nl2br($inventoryLock['InventoryLock']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventoryLock['Location']['name'], array('controller' => 'locations', 'action' => 'view', $inventoryLock['Location']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if($inventoryLock['InventoryLock']['active'] && ($canUnlock)) echo $this->Html->link(__('Release Lock'), array('action' => 'release',$inventoryLock['InventoryLock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory Lock'), array('action' => 'add')); ?> </li>
		<li><?php // echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
	</ul>
</div>
<?php echo $this->element('reportdetails'); ?>