<div class="programsettings view">
<h2><?php  echo __('Programsetting'); ?></h2>
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
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Programsetting'), array('action' => 'edit', $programsetting['Programsetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Programsetting'), array('action' => 'delete', $programsetting['Programsetting']['id']), null, __('Are you sure you want to delete # %s?', $programsetting['Programsetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Programsettings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programsetting'), array('action' => 'add')); ?> </li>
	</ul>
</div>
