<div class="forms index">
<?php echo $this->Form->create('Form'); ?>
	<h2><?php echo __('Forms'); ?></h2>
	<?php echo $this->element('filterblock'); ?>
	<?php echo $this->element('reportdetails'); ?>
	<table cellpadding="0" cellspacing="0">
<?php //debug($forms) ?>
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('FormGroup.name','Group'); ?></th>
			<th><?php echo $this->Paginator->sort('controller'); ?></th>
			<th><?php echo $this->Paginator->sort('action'); ?></th>
			<th><?php echo $this->Paginator->sort('add_menu'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_id','Created By'); ?></th>
			<th><?php //echo $this->Paginator->sort('link'); ?></th>
			<th><?php echo $this->Paginator->sort('helplink'); ?></th>
			<th></th>
	</tr>
	<?php
	foreach ($forms as $form): ?>
	<tr>
		<td><?php echo h($form['Form']['name']); ?>&nbsp;</td>
		<td><?php echo h($form['FormGroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['controller']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['action']); ?>&nbsp;</td>
		<td><?php if($form['Form']['add_menu']) echo 'Y'; ?>&nbsp;</td>
		<td><?php echo h($form['Form']['created']); ?>&nbsp;</td>
		<td><?php echo h($usersList[$form['Form']['created_id']]); ?>&nbsp;</td>
		<td><?php //echo h($form['Form']['link']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['helplink']); ?>&nbsp;</td>
		<td class="actions">
			<?php if($form['Form']['add_menu']) echo $this->Html->link(__('View'), array('controller'=>$form['Form']['controller'],'action'=>$form['Form']['action'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $form['Form']['id'],'redirect'=>$redirect)); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $form['Form']['id']), null, __('Are you sure you want to delete # %s?', $form['Form']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paginatorblock');?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Form Groups'), array('controller' => 'formGroups', 'action' => 'index'), array('class'=>'actions')); ?></li>
		<li><?php //echo $this->Html->link(__('New Form Group'), array('controller' => 'formGroups', 'action' => 'add'), array('class'=>'actions')); ?></li>
	</ul>
</div>
