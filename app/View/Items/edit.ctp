<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ItemDetail.name',array('id'=>'sc'));
		echo $this->Form->input('ItemDetail.sku');
		echo $this->Form->input('ItemDetail.upc');
		if($itemGroups) echo $this->Form->input('ItemGroup',array('multiple'=>'checkbox','label'=>'Item Groups'));
		if($categories) echo $this->Form->input('category_id',array('label'=>'Item Category'));
		if(!empty($this->data['Image'])) {
			//show images
			echo '<h3>Images</h3><table>';
			foreach($this->data['Image'] as $image) {
				//loop for all images
				echo '<tr><td>'.$this->Html->image($image['thumbnail']).'</td>';
				echo '<td>'.$this->Form->input('removeImage.'.$image['id'],array('label'=>'Remove','type'=>'checkbox')).'</td></tr>';
			}//end foreach
			echo '</table>';
		}//endif
// debug($this->data);
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Upload Image'), array('controller'=>'images','action' => 'add', 'item_id'=>$this->data['Item']['id'], 'redirect'=>array('controller'=>'items','action'=>'edit',$this->data['Item']['id']))); ?> </li>
	</ul>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>