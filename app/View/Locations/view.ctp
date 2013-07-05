<div class="locations view">
<h2><?php  echo __('Location: ').$location['Location']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<?php if($location['LocationType']['name']): ?>
			<dt><?php echo __('Location Type'); ?></dt>
			<dd>
				<?php echo $location['LocationType']['name']; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($location['ParentLocation']['name']): ?>
			<dt><?php echo __('Parent Location'); ?></dt>
			<dd>
				<?php echo $this->Html->link($location['ParentLocation']['name'], array('controller' => 'locations', 'action' => 'view', $location['ParentLocation']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if(count($path)>1): ?>
			<dt><?php echo __('Location Path'); ?></dt>
			<dd>
				<?php
					foreach($path as $i=>$p) {
						//loop for all path elements
						if($i) echo '->';
						//dont show link for current location
						if(($i+1)==count($path)) echo $p['Location']['name'];
						else echo $this->Html->link($p['Location']['name'],array('controller'=>'locations','action'=>'view',$p['Location']['id']));
					}//end foreach
				?>
			</dd>
		<?php endif; ?>
	</dl>
</div>
<?php //debug($location);exit?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Child Location'), array('controller' => 'locations', 'action' => 'add', $location['Location']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($location['Revisions'])): ?>
	<h3><?php echo __('Related Location Details'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;debug($location['LocationDetail']);
		foreach ($location['LocationDetail'] as $locationDetail): ?>
		<tr>
			<td><?php echo $locationDetail['id']; ?></td>
			<td><?php echo $locationDetail['created']; ?></td>
			<td><?php echo $locationDetail['created_id']; ?></td>
			<td><?php echo $locationDetail['name']; ?></td>
			<td><?php echo $locationDetail['parent_id']; ?></td>
			<td><?php echo $locationDetail['location_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'location_details', 'action' => 'view', $locationDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'location_details', 'action' => 'edit', $locationDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'location_details', 'action' => 'delete', $locationDetail['id']), null, __('Are you sure you want to delete # %s?', $locationDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($location['ChildLocation'])): ?>
	<h3><?php echo __('Direct Child Locations'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['ChildLocation'] as $childLocation): ?>
		<tr>
			<td><?php echo $this->Html->link($childLocation['name'], array('controller' => 'locations', 'action' => 'view', $childLocation['id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'locations', 'action' => 'view', $childLocation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'locations', 'action' => 'edit', $childLocation['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'locations', 'action' => 'delete', $childLocation['id']), null, __('Are you sure you want to delete # %s?', $childLocation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<?php if (!empty($items)): ?>
	<h3><?php echo __('Items at this Location'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th></th>
	</tr>
	<?php
		$i = 0;//debug($location['Item']);
		foreach ($items as $item): ?>
		<tr>
			<td><?php echo $this->Html->link($item['Item']['name'], array('controller' => 'items', 'action' => 'view', $item['Item']['id'])); ?></td>
			<td><?php echo $item['ItemsLocation']['qty']; ?></td>
			<td><?php echo $this->Html->link($item['Location']['name'],array('controller'=>'locations','action'=>'view',$item['Location']['id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
