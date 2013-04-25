<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pricing for Item: ').$this->request->data['Item']['name']; ?></legend>
	<?php
		echo $this->Form->input('id');
	?>
	<fieldset><legend><?php echo __('Default Pricing') ?></legend>
		<table>
			<tr><th>Qty</th><th>Price</th><th></th></tr>
			<tr><td>0</td><td><?php echo $this->Form->input('Default.0.price',array('label'=>'','id'=>'sc')); ?></td><td></td></tr> 
			<?php
				echo $this->Form->input('Default.0.qty',array('type'=>'hidden','value'=>0));
				echo $this->Form->input('Default.0.id',array('type'=>'hidden'));
				foreach($this->request->data['Default'] as $i=>$p) {
					//loop for all price points and show inputs
					echo '<tr>';
					$i++;
					echo '<td>'.$this->Form->input("Default.$i.qty",array('label'=>'')).'</td>';
					echo '<td>'.$this->Form->input("Default.$i.price",array('label'=>'')).'</td>';
					echo '<td>'.'</td>';
					echo '</tr>';
					echo $this->Form->input("Default.$i.id",array('type'=>'hidden')).'</td>';
				}//end foreach
			?>
		</table>
	</fieldset>
	<fieldset><legend><?php echo __('Customer Pricing') ?></legend>
		<table>
			<tr><th>Customer</th><th>Qty</th><th>Price</th><th></th></tr>
		</table>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<?php
debug($this->request->data)  ?>
<script type='text/javascript'>document.getElementById('sc').focus();</script>