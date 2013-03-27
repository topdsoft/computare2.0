<div class="locations view">
<h2><?php  echo __('Location'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location Detail'); ?></dt>
		<dd>
			<?php echo $this->Html->link($location['LocationDetail']['name'], array('controller' => 'location_details', 'action' => 'view', $location['LocationDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($location['Location']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($location['Location']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($location['ParentLocation']['id'], array('controller' => 'locations', 'action' => 'view', $location['ParentLocation']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location'), array('action' => 'delete', $location['Location']['id']), null, __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Location Details'), array('controller' => 'location_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location Detail'), array('controller' => 'location_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Location Details'); ?></h3>
	<?php if (!empty($location['LocationDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['LocationDetail'] as $locationDetail): ?>
		<tr>
			<td><?php echo $locationDetail['id']; ?></td>
			<td><?php echo $locationDetail['created']; ?></td>
			<td><?php echo $locationDetail['created_id']; ?></td>
			<td><?php echo $locationDetail['name']; ?></td>
			<td><?php echo $locationDetail['parent_id']; ?></td>
			<td><?php echo $locationDetail['location_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'location_details', 'action' => 'view', $locationDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'location_details', 'action' => 'edit', $locationDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'location_details', 'action' => 'delete', $locationDetail['id']), null, __('Are you sure you want to delete # %s?', $locationDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Location Detail'), array('controller' => 'location_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Locations'); ?></h3>
	<?php if (!empty($location['ChildLocation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('LocationDetail Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['ChildLocation'] as $childLocation): ?>
		<tr>
			<td><?php echo $childLocation['id']; ?></td>
			<td><?php echo $childLocation['locationDetail_id']; ?></td>
			<td><?php echo $childLocation['lft']; ?></td>
			<td><?php echo $childLocation['rght']; ?></td>
			<td><?php echo $childLocation['parent_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'locations', 'action' => 'view', $childLocation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'locations', 'action' => 'edit', $childLocation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'locations', 'action' => 'delete', $childLocation['id']), null, __('Are you sure you want to delete # %s?', $childLocation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Items'); ?></h3>
	<?php if (!empty($location['Item'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('ItemDetail Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Serialized'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['created']; ?></td>
			<td><?php echo $item['itemDetail_id']; ?></td>
			<td><?php echo $item['active']; ?></td>
			<td><?php echo $item['serialized']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
