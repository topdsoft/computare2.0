<?php echo $this->Form->create('Item'); ?>
<?php
	echo $this->Html->css('cake.generic');
// debug($items);
?>
<fieldset><legend>Item Search</legend>
<?php
	echo $this->Form->input('name',array('id'=>'sc'));
	echo $this->Form->input('sku',array('label'=>'SKU'));
	echo $this->Form->input('upc',array('label'=>'UPC'));
	
	echo $this->Form->end(__('Find'));
?>
</fieldset>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('ItemCategory.name','Category'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('serialized'); ?></th>
	</tr>
	<?php  //debug($items);
	foreach ($items as $item): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link(__('Select'),'#', array('onclick' => 'select('.$item['Item']['id'].')')); ?>
		</td>
		<td><?php echo h($item['Item']['name']); ?>&nbsp;</td>
		<td><?php echo h($item['Item']['qty']); ?>&nbsp;</td>
		<td><?php
//echo $this->Html->link($item['ItemCategory']['name'],array('controller'=>'itemCategories','action'=>'view',$item['ItemCategory']['id'])); 
			if($item['path']) {
				foreach($item['path'] as $i=>$path) {
					//loop for each step of path
					if($i!=0) echo '->';
					echo $path['ItemCategory']['name'];
				}//endforeach
			}//endif
		?>&nbsp;</td>
		<td><?php echo h($item['Item']['created']); ?>&nbsp;</td>
		<td><?php if($item['Item']['serialized']) echo 'Y'; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<script type='text/javascript'>document.getElementById('sc').focus();</script>
	<script type='text/javascript'>

		function select(id) {
			//user has selected an item, return to previous form
			opener.document.getElementById('<?php echo $this->request->params['named']['inputId']; ?>').value=id;
			self.close();
		}
		
	</script>