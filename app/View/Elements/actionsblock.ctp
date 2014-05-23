<?php  if(isset($actions)): ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php 
			foreach($actions as $action) {
				//loop for all actions
				echo '<li>'.$this->Html->link($action[0],$action[1]).'</li>';
			}//end foreach
		?>
	</ul>
</div>
<?php endif; //debug($actions);

