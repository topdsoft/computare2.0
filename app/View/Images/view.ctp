<div class="images view">
<h2><?php  echo __('Image'); ?></h2>
	<dl>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($image['Image']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$image['Image']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($image['Image']['filename']); ?>
			&nbsp;
		</dd>
	</dl>
	<?php echo $this->Html->image($image['Image']['filename']); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Image'), array('action' => 'edit', $image['Image']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Image'), array('action' => 'delete', $image['Image']['id']), null, __('Are you sure you want to delete # %s?', $image['Image']['id'])); ?> </li>
		<li><?php //echo $this->Html->link(__('List Images'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Image'), array('action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($image['Item'])): ?>
	<h3><?php echo __('Related Items'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($image['Item'] as $item): ?>
		<tr>
			<td><?php echo $this->Html->link($item['name'],array('controller'=>'items','action'=>'view',$item['id'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
