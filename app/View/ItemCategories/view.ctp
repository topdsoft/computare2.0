<div class="itemCategories view">
<h2><?php  echo __('Item Category: ').$itemCategory['ItemCategory']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($itemCategory['ItemCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemCategory['ItemCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itemCategory['ItemCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$itemCategory['ItemCategory']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemCategory['ParentItemCategory']['name'], array('controller' => 'item_categories', 'action' => 'view', $itemCategory['ParentItemCategory']['id'])); ?>
			&nbsp;
		</dd>
		<?php if($path): ?>
			<dt><?php echo __('Category Path'); ?></dt>
			<dd>
				<?php 
					foreach ($path as $i=>$p) {
						//loop for all categories in path
						if($i) echo '->';
						echo $this->Html->link($p['ItemCategory']['name'], array('controller'=>'itemCategories','action'=>'view',$p['ItemCategory']['id']));
					}//end foreach
				?>
			</dd>
		<?php endif; ?>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Category'), array('action' => 'edit', $itemCategory['ItemCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Child Category'), array('controller' => 'item_categories', 'action' => 'add', $itemCategory['ItemCategory']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($itemCategory['ChildItemCategory'])): ?>
	<h3><?php echo __('Child Categories'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($itemCategory['ChildItemCategory'] as $childItemCategory): ?>
		<tr>
			<td><?php echo $this->Html->link($childItemCategory['name'], array('controller' => 'item_categories', 'action' => 'view', $childItemCategory['id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'item_categories', 'action' => 'view', $childItemCategory['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'item_categories', 'action' => 'edit', $childItemCategory['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'item_categories', 'action' => 'delete', $childItemCategory['id']), null, __('Are you sure you want to delete # %s?', $childItemCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<?php //debug($path);?>
<div class="related">
	<?php if (!empty($items)): ?>
	<h3><?php echo __('Items in Category'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sub Category'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($items as $item): ?>
		<tr>
			<td><?php echo $this->Html->link($item['Item']['name'], array('controller' => 'items', 'action' => 'view', $item['Item']['id'])); ?></td>
			<td><?php echo $this->Html->link($categories[$item['Item']['category_id']], array('controller' => 'itemCategories', 'action' => 'view', $item['Item']['category_id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
