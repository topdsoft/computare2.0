<div class="vehicles form">
<?php echo $this->Form->create('Vehicle'); ?>
	<fieldset>
		<legend><?php echo __('Add Vehicle'); ?></legend>
	<?php
<<<<<<< HEAD
		echo $this->Form->input('customer_id');
		echo $this->Form->input('vin');
		echo $this->Form->input('description');
=======
		echo $this->Form->input('created_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('vin');
		echo $this->Form->input('description');
		echo $this->Form->input('Image');
>>>>>>> 44d296b63133d3d505eb6f2f10a5717a5030ee88
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Vehicles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
<<<<<<< HEAD
		<li><?php echo $this->Html->link(__('New Customer'), array('controller'=>'customers','action' => 'edit','redirect'=>array('controller'=>'vehicles','action'=>'add'))); ?> </li>
=======
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Notes'), array('controller' => 'vehicle_notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Note'), array('controller' => 'vehicle_notes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Visits'), array('controller' => 'vehicle_visits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Visit'), array('controller' => 'vehicle_visits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
>>>>>>> 44d296b63133d3d505eb6f2f10a5717a5030ee88
	</ul>
</div>
