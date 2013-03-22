<div class="users view">
<h2><?php  echo __('User').': '.$user['User']['username']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Homepage'); ?></dt>
		<dd>
			<?php echo h($user['User']['homepage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php //debug($user); ?>

<?php if (!empty($user['UserGroup'])): ?>
	<div class="related">
		<h3><?php echo __('Groups User Belongs To'); ?></h3>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Name'); ?></th>
		</tr>
		<?php
			foreach($user['UserGroup'] as $group) {
				//loop for all groups
				echo '<tr>';
				echo '<td>'.$group['name'].'</td>';
				echo '</tr>';
// debug($group);
			}//end foreach
		?>
		</table>
	</div>
<?php endif; ?>
