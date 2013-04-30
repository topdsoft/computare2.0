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
	<fieldset><legend><?php echo __('Individual Customer Pricing') ?></legend>
		<table>
			<tr><th>Customer</th><th>Qty</th><th>Price</th><th></th></tr>
			<?php
				foreach($this->request->data['Customer'] as $customer_id=>$groupData) {
					//loop for each different customer
					echo '<tr><td>'.$groupData[0]['name'].'</td><td>0</td><td>';
					echo $this->Form->input("Customer.$customer_id.0.price",array('label'=>'')).'</td><td></td></tr>';
					echo $this->Form->input("Customer.$customer_id.0.qty",array('type'=>'hidden','value'=>0));
					echo $this->Form->input("Customer.$customer_id.0.id",array('type'=>'hidden'));
					foreach($groupData as $i=>$p){
						//loop for all price points for this customer
						echo '<tr><td></td>';
						$i++;
						echo '<td>'.$this->Form->input("Customer.$customer_id.$i.qty",array('label'=>'')).'</td>';
						echo '<td>'.$this->Form->input("Customer.$customer_id.$i.price",array('label'=>'')).'</td>';
						echo '<td>'.'</td>';
						echo '</tr>';
						echo $this->Form->input("Customer.$customer_id.$i.id",array('type'=>'hidden')).'</td>';
					}//end foreach
					echo '<tr><td></td><td></td><td></td><td></td></tr>';
				}//endforeach
			?>
			<?php
				if($customers) {
					//show option to add new group pricing only if unused group(s) are available
					echo '<tr>';
					echo '<td>'.$this->Form->input('Customer.customer_id',array('label'=>'Select a New Customer')).'</td>';
					echo '<td>0</td><td>'.$this->Form->input('Customer.price',array('label'=>'')).'</td>';
					echo '</tr>';
				}//endif
			?>
		</table>
	</fieldset>
	<fieldset><legend><?php echo __('Customer Group Pricing') ?></legend>
		<table>
			<tr><th>Group</th><th>Qty</th><th>Price</th><th></th></tr>
			<?php
				foreach($this->request->data['CustomerGroup'] as $customerGroup_id=>$groupData) {
					//loop for each different customer group
					echo '<tr><td>'.$groupData[0]['name'].'</td><td>0</td><td>';
					echo $this->Form->input("CustomerGroup.$customerGroup_id.0.price",array('label'=>'')).'</td><td></td></tr>';
					echo $this->Form->input("CustomerGroup.$customerGroup_id.0.qty",array('type'=>'hidden','value'=>0));
					echo $this->Form->input("CustomerGroup.$customerGroup_id.0.id",array('type'=>'hidden'));
					foreach($groupData as $i=>$p){
						//loop for all price points for this customer group
						echo '<tr><td></td>';
						$i++;
						echo '<td>'.$this->Form->input("CustomerGroup.$customerGroup_id.$i.qty",array('label'=>'')).'</td>';
						echo '<td>'.$this->Form->input("CustomerGroup.$customerGroup_id.$i.price",array('label'=>'')).'</td>';
						echo '<td>'.'</td>';
						echo '</tr>';
						echo $this->Form->input("CustomerGroup.$customerGroup_id.$i.id",array('type'=>'hidden')).'</td>';
					}//end foreach
					echo '<tr><td></td><td></td><td></td><td></td></tr>';
				}//endforeach
			?>
			<?php
				if($customerGroups) {
					//show option to add new group pricing only if unused group(s) are available
					echo '<tr>';
					echo '<td>'.$this->Form->input('CustomerGroup.customerGroup_id',array('label'=>'Select a New Customer Group')).'</td>';
					echo '<td>0</td><td>'.$this->Form->input('CustomerGroup.price',array('label'=>'')).'</td>';
					echo '</tr>';
				}//endif
			?>
		</table>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<?php
// debug($this->request->data)  ?>
<script type='text/javascript'>document.getElementById('sc').focus();</script>