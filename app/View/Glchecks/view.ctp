<div class="glchecks view">
<h2><?php  echo __('Glcheck'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($glcheck['Glcheck']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($glcheck['Glcheck']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CheckNumber'); ?></dt>
		<dd>
			<?php echo h($glcheck['Glcheck']['checkNumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($glcheck['Glcheck']['amount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Glcheck'), array('action' => 'edit', $glcheck['Glcheck']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Glcheck'), array('action' => 'delete', $glcheck['Glcheck']['id']), null, __('Are you sure you want to delete # %s?', $glcheck['Glcheck']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Glchecks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glcheck'), array('action' => 'add')); ?> </li>
	</ul>
</div>
