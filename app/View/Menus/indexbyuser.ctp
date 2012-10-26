<div class="menus index">
	<h2><?php echo __('Menus for User: '.$username); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Display Label</th>
			<th>Menu Type</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
	</tr>
	<?php
	$i=0;
	foreach ($menus as $menu): ?>
	<tr>
		<td><?php echo h($menu['Menu']['name']); ?>&nbsp;</td>
		<td><?php echo $menu['Menu']['user_id']==0 ? 'Public' : 'Private'; ?>&nbsp;</td>
		<td></td>
		<td></td>
		<td class="actions">
			<?php if($i>0) echo $this->Form->postLink(__('Move Up'), array('action' => 'moveup', $menu['MenusUser']['id'])); ?>
			<?php $i++; if($i<count($menus)) echo $this->Form->postLink(__('Move Down'), array('action' => 'movedown', $menu['MenusUser']['id'])); ?>
		</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
//debug($menus);
	?>	</p>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
