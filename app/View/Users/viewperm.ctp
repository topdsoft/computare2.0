<div class="users view">
<h2><?php  echo __('User').': '.$user['User']['username']; ?></h2>
</div>

<?php 
// debug($user); ?>

<?php if (!empty($user['Form'])): ?>
	<div class="related">
		<h3><?php echo __('Permissions to Individual Forms'); ?></h3>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Form'); ?></th>
			<?php foreach($permissions as $p) echo "<th>$p</th>"; ?>
		</tr>
		<?php
			foreach($user['Form'] as $form) {
				//loop for all groups
				echo '<tr>';
				echo '<td>'.$form['name'].'</td>';
				foreach($permissions as $p) {
					//loop for all forms
					echo "<td>";
					if($form['PermissionSet'][$p]) echo 'Y';
					elseif($form['Token'][$p]) echo '*';
					echo "</td>";
					
				}//endforeach
				echo '</tr>';
// debug($form);
			}//end foreach
		?>
		</table>
	</div>
<?php endif; ?>

<?php if (!empty($user['FormGroup'])): ?>
	<div class="related">
		<h3><?php echo __('Permissions to Form Groups'); ?></h3>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Group'); ?></th>
			<th><?php echo __('Form'); ?></th>
			<?php foreach($permissions as $p) echo "<th>$p</th>"; ?>
		</tr>
		<?php
			foreach($user['FormGroup'] as $group) {
				//loop for all groups
				foreach($group['Form'] as $form) {
					//loop for each form in the group
					echo '<tr>';
					echo '<td>'.$group['name'].'</td>';
					echo '<td>'.$form['name'].'</td>';
					foreach($permissions as $p) {
						//check each permission vs token
						echo "<td>";
						if($group['PermissionSet'][$p]) echo 'Y';
						elseif($form['Token'][$p]) echo '*';
						echo "</td>";
					}//endforeach
					echo '</tr>';//debug($form);
				}//end foreach
//  debug($group);
			}//end foreach
		?>
		</table>
	</div>
<?php endif; ?>

<?php if (!empty($user['UserGroup'])): ?>
	<div class="related">
		<h3><?php echo __('Group Permissions to Individual Forms'); ?></h3>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Group'); ?></th>
			<th><?php echo __('Form'); ?></th>
			<?php foreach($permissions as $p) echo "<th>$p</th>"; ?>
		</tr>
		<?php
			foreach($user['UserGroup'] as $group) {
				//loop for all groups
				foreach($group['Form'] as $form) {
					//loop for each form in the group
					echo '<tr>';
					echo '<td>'.$group['name'].'</td>';
					echo '<td>'.$form['name'].'</td>';
					foreach($permissions as $p) {
						//loop and check each permission vs. token
						echo "<td>";
						if($form['PermissionSet'][$p]) echo 'Y';
						elseif($form['Token'][$p]) echo '*';
						echo "</td>";
					}//endforeach
					echo '</tr>';
				}//end foreach
//  debug($group);
			}//end foreach
		?>
		</table>
	</div>
<?php endif; ?>

<?php if (!empty($user['UserGroup'])): ?>
	<div class="related">
		<h3><?php echo __('Group Permissions to Group Forms'); ?></h3>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('User Group'); ?></th>
			<th><?php echo __('Form Group'); ?></th>
			<th><?php echo __('Form'); ?></th>
			<?php foreach($permissions as $p) echo "<th>$p</th>"; ?>
		</tr>
		<?php
			foreach($user['UserGroup'] as $userGroup) {
				//loop for all user groups
				foreach($userGroup['FormGroup'] as $formGroup) {
					//loop for each form group
					foreach($formGroup['Form'] as $form) {
						//loop for each form in the group
						echo '<tr>';
						echo '<td>'.$userGroup['name'].'</td>';
						echo '<td>'.$formGroup['name'].'</td>';
						echo '<td>'.$form['name'].'</td>';
						foreach($permissions as $p) {
							//loop and check against token
							echo "<td>";
							if($formGroup['PermissionSet'][$p]) echo 'Y';
							elseif($form['Token'][$p]) echo '*';
							echo "</td>";
						}//endforeach
						echo '</tr>';
					}//end foreach
				}//end foreach
//  debug($group);
			}//end foreach
		?>
		</table>
		"*" Means the user has this permission, but granted by another permission set.
	</div>
<?php endif; ?>
