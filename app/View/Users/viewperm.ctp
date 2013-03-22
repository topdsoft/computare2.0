<div class="users view">
<h2><?php  echo __('User').': '.$user['User']['username']; ?></h2>
</div>

<?php debug($user); ?>

<?php if (!empty($user['Form'])): ?>
	<div class="related">
		<h3><?php echo __('Individually set Permissions'); ?></h3>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Name'); ?></th>
			<?php foreach($permissions as $p) echo "<th>$p</th>"; ?>
		</tr>
		<?php
			foreach($user['Form'] as $form) {
				//loop for all groups
				echo '<tr>';
				echo '<td>'.$form['name'].'</td>';
				foreach($permissions as $p) echo "<td>".$form['PermissionSet'][$p]."</td>";
				echo '</tr>';
// debug($form);
			}//end foreach
		?>
		</table>
	</div>
<?php endif; ?>
