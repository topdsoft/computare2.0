<div class="programsettings view">
<h2><?php  echo __('Program Settings'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($programsetting['Programsetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($programsetting['Programsetting']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($programsetting['Programsetting']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dbschema'); ?></dt>
		<dd>
			<?php echo h($programsetting['Programsetting']['dbschema']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($programsetting['Programsetting']['full_name']); ?>
			&nbsp;
		</dd>
		<?php if($lastprogramsetting): ?>
		<h3>Revisions</h3>
		<?php
			echo 'On '.$programsetting['Programsetting']['created'].' by '.$userlist[$programsetting['Programsetting']['created_id']];
			$ignore=array('id','created','created_id');
			foreach($programsetting['Programsetting'] as $id=>$value) {
				//loop for all values
				if(!in_array($id,$ignore) && $lastprogramsetting['Programsetting'][$id]!=$value) {
					//show difference
					echo '<dt>'.$id.' from</dt>';
					echo '<dd>'.$lastprogramsetting['Programsetting'][$id].'</dd>';
					echo '<dt>'.$id.' to</dt>';
					echo '<dd>'.$value.'</dd>';
				}//endif
			}//endforeach
			endif;
		?>
	</dl>
</div>
