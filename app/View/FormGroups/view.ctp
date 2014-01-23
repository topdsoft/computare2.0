<div class="formGroups view">
<h2><?php  echo __('Form Group: ').$formGroup['FormGroup']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($formGroup['FormGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($formGroup['FormGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$formGroup['FormGroup']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($formGroup['FormGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Form Group'), array('action' => 'edit', $formGroup['FormGroup']['id'])); ?> </li>
	</ul>
</div>
<?php echo $this->element('reportdetails'); ?>
<div class="related">
	<h3><?php echo __('Related Forms'); ?></h3>
	<?php if (!empty($formGroup['Form'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Helplink'); ?></th>
		<th><?php echo __('Controller'); ?></th>
		<th><?php echo __('Action'); ?></th>
		<th><?php echo __('Add Menu'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($formGroup['Form'] as $form): ?>
		<tr>
			<td title="<?php echo $form['description'] ?>"><?php echo $form['name']; ?></td>
			<td><?php echo $form['link']; ?></td>
			<td><?php echo $form['helplink']; ?></td>
			<td><?php echo $form['controller']; ?></td>
			<td><?php echo $form['action']; ?></td>
			<td><?php if($form['add_menu']) echo 'Y'; ?></td>
			<td><?php echo $form['created']; ?></td>
			<td><?php echo $users[$form['created_id']]; ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'forms', 'action' => 'view', $form['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forms', 'action' => 'edit', $form['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'forms', 'action' => 'delete', $form['id']), null, __('Are you sure you want to delete # %s?', $form['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<?php echo $this->Html->script('sliderelated.js') ?>