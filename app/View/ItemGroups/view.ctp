<div class="itemGroups view">
<h2><?php  echo __('Item Group: ').$itemGroup['ItemGroup']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$itemGroup['ItemGroup']['created_id']]; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Group'), array('action' => 'edit', $itemGroup['ItemGroup']['id'])); ?> </li>
	</ul>
</div>
<?php
// debug($itemGroup);?>
<div class="related">
	<?php if (!empty($itemGroup['Item'])): ?>
	<h3><?php echo __('Items in Group'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($itemGroup['Item'] as $item): ?>
		<tr>
			<td><?php echo $this->Html->link($item['name'],array('controller'=>'items','action'=>'view',$item['id'])) ; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_costs', 'action' => 'view', $itemCost['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_costs', 'action' => 'edit', $itemCost['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_costs', 'action' => 'delete', $itemCost['id']), null, __('Are you sure you want to delete # %s?', $itemCost['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
