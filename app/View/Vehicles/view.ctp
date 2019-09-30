<div class="vehicles view">
<h2><?php echo __('Vehicle: ').h($vehicle['Vehicle']['description']); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Status'); ?></dt>
		<dd>
			<?php 
				if($isInShop) {
					//is in shop curretnly
					echo h("Currently in Shop Since: ").$vehicle['VehicleVisit'][0]['created']; 
				} else {
					//not in shop currently
					echo h("Not Currently in Shop"); 
				}//endif
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($users[$vehicle['Vehicle']['created_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vehicle['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $vehicle['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vin'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['vin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vehicle'), array('action' => 'edit', $vehicle['Vehicle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vehicle'), array('action' => 'delete', $vehicle['Vehicle']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicle['Vehicle']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Vehicle Notes'); ?></h3>
	<?php if (!empty($vehicle['VehicleNote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th></th>
	</tr>
	<?php foreach ($vehicle['VehicleNote'] as $vehicleNote): ?>
		<tr>
			<td><?php echo $vehicleNote['created']; ?></td>
			<td><?php echo $users[$vehicleNote['created_id']]; ?></td>
			<td><?php echo nl2br($vehicleNote['note']); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'vehicle_notes', 'action' => 'view', $vehicleNote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vehicle_notes', 'action' => 'edit', $vehicleNote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vehicle_notes', 'action' => 'delete', $vehicleNote['id'], $vehicle['Vehicle']['id']), array('confirm' => __('Are you sure you want to delete this note?'))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vehicle Note'), array('controller' => 'vehicle_notes', 'action' => 'add', $vehicle['Vehicle']['id'])); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Vehicle Visits'); ?></h3>
	<?php if (!empty($vehicle['VehicleVisit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Enters'); ?></th>
		<th><?php echo __('Entered By'); ?></th>
		<th><?php echo __('Exits'); ?></th>
		<th><?php echo __('Exited By'); ?></th>
	</tr>
	<?php foreach ($vehicle['VehicleVisit'] as $vehicleVisit): ?>
		<tr>
			<td><?php echo $vehicleVisit['created']; ?></td>
			<td><?php echo $users[$vehicleVisit['created_id']]; ?></td>
			<td><?php echo $vehicleVisit['exits']; ?></td>
			<td><?php if($vehicleVisit['exits']) echo $users[$vehicleVisit['exit_id']]; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php 
				if($isInShop) echo $this->Html->link(__('Check Vehicle Out'), array('controller' => 'vehicle_visits', 'action' => 'edit', $vehicle['VehicleVisit'][0]['id']));
				else echo $this->Html->link(__('Check Vehicle In'), array('controller' => 'vehicle_visits', 'action' => 'add',$vehicle['Vehicle']['id'])); 
			?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Images'); ?></h3>
	<?php if (!empty($vehicle['Image'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th><?php echo __('Thumbnail'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicle['Image'] as $image): ?>
		<tr>
			<td><?php echo $image['id']; ?></td>
			<td><?php echo $image['created']; ?></td>
			<td><?php echo $image['created_id']; ?></td>
			<td><?php echo $image['filename']; ?></td>
			<td><?php echo $image['thumbnail']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'images', 'action' => 'delete', $image['id']), array('confirm' => __('Are you sure you want to delete # %s?', $image['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
