<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pricing for Customer: ').$this->request->data['Customer']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('CustomerDetail.customer_id',array('type'=>'hidden'));
// debug($this->request->data);
//		echo $this->Form->input('customerDetail_id');
	?>
		<table>
			<tr><th>Item</th><th>Qty</th><th>Price</th><th></th></tr>
			<?php
				foreach($this->request->data['Item'] as $item_id=>$groupData) {
					//loop for each different item
					echo '<tr><td>'.$groupData[0]['name'].'</td><td>0</td><td>';
					echo $this->Form->input("Item.$item_id.0.price",array('label'=>'')).'</td><td></td></tr>';
					echo $this->Form->input("Item.$item_id.0.qty",array('type'=>'hidden','value'=>0));
					echo $this->Form->input("Item.$item_id.0.id",array('type'=>'hidden'));
					foreach($groupData as $i=>$p){
						//loop for all price points for this customer
						echo '<tr><td></td>';
						$i++;
						echo '<td>'.$this->Form->input("Item.$item_id.$i.qty",array('label'=>'')).'</td>';
						echo '<td>'.$this->Form->input("Item.$item_id.$i.price",array('label'=>'')).'</td>';
						echo '<td>'.'</td>';
						echo '</tr>';
						echo $this->Form->input("Item.$item_id.$i.id",array('type'=>'hidden')).'</td>';
					}//end foreach
					echo '<tr><td></td><td></td><td></td><td></td></tr>';
				}//endforeach
			?>
			<?php
				if($items) {
					//show option to add new item pricing only if unused item(s) are available
					echo '<tr>';
					echo '<td>'.$this->Form->input('Item.item_id',array('label'=>'Select a New Item',
						'after'=>$this->element('itemPopUp',array('inputId'=>'ItemItemId')))).'</td>';
					echo '<td>0</td><td>'.$this->Form->input('Item.price',array('label'=>'')).'</td>';
					echo '</tr>';
				}//endif
			?>
		</table>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('ItemItemId').focus();</script>
<?php echo $this->Html->script('formInputs.js'); ?>