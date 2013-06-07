<div class="stockLevels view">
<h2><?php  echo __('Stock Level'); ?></h2>
	<dl>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stockLevel['Location']['name'], array('controller' => 'locations', 'action' => 'view', $stockLevel['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stockLevel['Item']['name'], array('controller' => 'items', 'action' => 'view', $stockLevel['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd>
			<?php echo h($stockLevel['StockLevel']['qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priority'); ?></dt>
		<dd>
			<?php echo h($stockLevel['StockLevel']['priority']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($stockLevel['StockLevel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('By'); ?></dt>
		<dd>
			<?php echo $users[$stockLevel['StockLevel']['created_id']]; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php if(!empty($revisions)): ?>
	<div class="related">
	<h3>Old Stock Levels</h3>
	<table>
	<tr><th>Qty</th><th>Priority</th><th>Created</th><th>By</th></tr>
	<?php
		foreach($revisions as $revision) {
			//loop and display all revisions
			echo '<tr>';
			echo '<td>'.$revision['StockLevel']['qty'].'</td>';
			echo '<td>'.$revision['StockLevel']['priority'].'</td>';
			echo '<td>'.$revision['StockLevel']['created'].'</td>';
			echo '<td>'.$users[$revision['StockLevel']['created_id']].'</td>';
			echo '</tr>';
		}//end foreach
	?>
	</table>
	</div>
<?php endif; ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stock Level'), array('action' => 'edit',$stockLevel['StockLevel']['item_id'],$stockLevel['StockLevel']['location_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
	</ul>
</div>
