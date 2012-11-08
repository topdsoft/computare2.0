<div class="glentries view">
<h2><?php  echo __('Glentry'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($glentry['Glentry']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($glentry['Glentry']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Id'); ?></dt>
		<dd>
			<?php echo h($glentry['Glentry']['created_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PostDate'); ?></dt>
		<dd>
			<?php echo h($glentry['Glentry']['postDate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Glaccount'); ?></dt>
		<dd>
			<?php echo $this->Html->link($glentry['Glaccount']['id'], array('controller' => 'glaccounts', 'action' => 'view', $glentry['Glaccount']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Glcheck'); ?></dt>
		<dd>
			<?php echo $this->Html->link($glentry['Glcheck']['id'], array('controller' => 'glchecks', 'action' => 'view', $glentry['Glcheck']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Debit'); ?></dt>
		<dd>
			<?php echo h($glentry['Glentry']['debit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit'); ?></dt>
		<dd>
			<?php echo h($glentry['Glentry']['credit']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Glentry'), array('action' => 'edit', $glentry['Glentry']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Glentry'), array('action' => 'delete', $glentry['Glentry']['id']), null, __('Are you sure you want to delete # %s?', $glentry['Glentry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Glentries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glentry'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glaccounts'), array('controller' => 'glaccounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glaccount'), array('controller' => 'glaccounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Glchecks'), array('controller' => 'glchecks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Glcheck'), array('controller' => 'glchecks', 'action' => 'add')); ?> </li>
	</ul>
</div>
