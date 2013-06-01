<div class="inventoryLocks view">
<h2><?php  echo __('Inventory Lock'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['removed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed Id'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['removed_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($inventoryLock['InventoryLock']['notes']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Inventory Lock'), array('action' => 'edit', $inventoryLock['InventoryLock']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Inventory Lock'), array('action' => 'delete', $inventoryLock['InventoryLock']['id']), null, __('Are you sure you want to delete # %s?', $inventoryLock['InventoryLock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventory Locks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory Lock'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
