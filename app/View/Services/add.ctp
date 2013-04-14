<div class="services form">
<?php echo $this->Form->create('Service'); ?>
	<fieldset>
		<legend><?php echo __('Add Service'); ?></legend>
	<?php
		echo $this->Form->input('created_id');
		echo $this->Form->input('name');
		echo $this->Form->input('active');
		echo $this->Form->input('pricing');
		echo $this->Form->input('rate');
		echo $this->Form->input('fixedRate');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Services'), array('action' => 'index')); ?></li>
	</ul>
</div>
