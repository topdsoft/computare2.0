<div class="groups view">
<h2><?php  echo __('Group: ').h($group['UserGroup']['name']); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['UserGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($group['UserGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $users[$group['UserGroup']['created_id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($group['UserGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<?php if (!empty($group['Form'])): ?>
	<h3><?php echo __('Related Forms'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Helplink'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['Form'] as $form): ?>
		<tr>
			<td><?php echo $form['id']; ?></td>
			<td><?php echo $form['created']; ?></td>
			<td><?php echo $form['created_id']; ?></td>
			<td><?php echo $form['name']; ?></td>
			<td><?php echo $form['link']; ?></td>
			<td><?php echo $form['type']; ?></td>
			<td><?php echo $form['helplink']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forms', 'action' => 'view', $form['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forms', 'action' => 'edit', $form['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forms', 'action' => 'delete', $form['id']), null, __('Are you sure you want to delete # %s?', $form['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($group['User'])): ?>
	<h3><?php echo __('Group Members'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>

<div class="related">
	<?php if (!empty($permissions)): ?>
	<h3><?php echo __('Group Permissions'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Form'); ?></th>
		<th><?php echo __('Form Group'); ?></th>
		<?php foreach($permissionsList as $p) echo "<th>$p</th>"; ?>
	</tr>
	<?php
		$i = 0;
		foreach ($permissions as $permission): ?>
		<tr>
			<td><?php echo $permission['Form']['name']; ?></td>
			<td><?php echo $permission['FormGroup']['name']; ?></td>
			<?php
				foreach ($permissionsList as $p) {
					//loop for all permsissions
					echo '<td>';
					if($permission['PermissionSet'][$p]) echo 'Y';
					echo '</td>';
				}//end foreach
			?>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; //debug($permissions);?>
</div>