<div class="customerGroups view">
<h2><?php  echo __('Customer Group: ').$customerGroup['CustomerGroup']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customerGroup['CustomerGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($customerGroup['CustomerGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$customerGroup['CustomerGroup']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($customerGroup['CustomerGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //debug($customerGroup);?>
<div class="related">
	<?php if (!empty($customerGroup['Customer'])): ?>
	<h3><?php echo __('Customers'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Id'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customerGroup['Customer'] as $customer): ?>
		<tr>
			<td><?php echo $this->Html->link($customer['name'], array('controller' => 'customers', 'action' => 'view', $customer['id'])); ?></td>
			<td><?php echo $customer['id']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($customerGroup['Item'])): ?>
	<h3><?php echo __('Item Pricing'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('ItemDetail Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Serialized'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customerGroup['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['created']; ?></td>
			<td><?php echo $item['itemDetail_id']; ?></td>
			<td><?php echo $item['category_id']; ?></td>
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
</div>

<div class="related">
	<?php if (!empty($customerGroup['Service'])): ?>
	<h3><?php echo __('Service Pricing'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Pricing'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('FixedRate'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customerGroup['Service'] as $service): ?>
		<tr>
			<td><?php echo $service['id']; ?></td>
			<td><?php echo $service['created']; ?></td>
			<td><?php echo $service['created_id']; ?></td>
			<td><?php echo $service['name']; ?></td>
			<td><?php echo $service['active']; ?></td>
			<td><?php echo $service['pricing']; ?></td>
			<td><?php echo $service['rate']; ?></td>
			<td><?php echo $service['fixedRate']; ?></td>
			<td><?php echo $service['description']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'services', 'action' => 'view', $service['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'services', 'action' => 'edit', $service['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'services', 'action' => 'delete', $service['id']), null, __('Are you sure you want to delete # %s?', $service['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
