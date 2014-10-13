<div class="listTemplates view">
<h2><?php  echo __('List Template'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['removed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Removed Id'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['removed_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NewList Id'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['newList_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LinkedTo Id'); ?></dt>
		<dd>
			<?php echo h($listTemplate['ListTemplate']['linkedTo_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit List Template'), array('action' => 'edit', $listTemplate['ListTemplate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete List Template'), array('action' => 'delete', $listTemplate['ListTemplate']['id']), null, __('Are you sure you want to delete # %s?', $listTemplate['ListTemplate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List List Templates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New List Template'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List List Questions'), array('controller' => 'list_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New List Question'), array('controller' => 'list_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related List Questions'); ?></h3>
	<?php if (!empty($listTemplate['ListQuestion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Rank'); ?></th>
		<th><?php echo __('Label'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('ListTemplate Id'); ?></th>
		<th><?php echo __('Required'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($listTemplate['ListQuestion'] as $listQuestion): ?>
		<tr>
			<td><?php echo $listQuestion['id']; ?></td>
			<td><?php echo $listQuestion['created']; ?></td>
			<td><?php echo $listQuestion['created_id']; ?></td>
			<td><?php echo $listQuestion['rank']; ?></td>
			<td><?php echo $listQuestion['label']; ?></td>
			<td><?php echo $listQuestion['type']; ?></td>
			<td><?php echo $listQuestion['listTemplate_id']; ?></td>
			<td><?php echo $listQuestion['required']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'list_questions', 'action' => 'view', $listQuestion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'list_questions', 'action' => 'edit', $listQuestion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'list_questions', 'action' => 'delete', $listQuestion['id']), null, __('Are you sure you want to delete # %s?', $listQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New List Question'), array('controller' => 'list_questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
