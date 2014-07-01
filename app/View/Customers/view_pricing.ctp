<div class="customers form">
<?php echo $this->Form->create('Customer'); ?>
	<h2><?php echo __('Pricing for Customer: ').$this->request->data['Customer']['name']; ?></h2>
	<?php echo $this->element('reportdetails'); ?>
	<?php echo $this->element('actionsblock'); ?>
	<table>
		<tr><th>Item</th><th>Qty</th><th>Price</th></tr>
		<?php
			foreach($this->request->data['Item'] as $id=>$groupData) {
				//loop for each different item
				$first=true;
				foreach($groupData as $i=>$p){
					//loop for all price points for this customer
					if($first) {
						//show item name
						echo '<tr><td>'.$p['name'].'</td>';
						$first=false;
					}//end if first for this item
					else echo '<tr><td></td>';
					if(isset($groupData[$i+1]['qty'])) $nextQty=($groupData[$i+1]['qty']-1);
					else $nextQty='';
					echo '<td>'.$p['qty'].' - '.$nextQty.'</td>';
					echo '<td>'.$p['price'].'</td>';
// 						echo '<td>'.'</td>';
					echo '</tr>';
				}//end foreach
					echo '<tr><td></td><td></td><td></td></tr>';
			}//endforeach
		?>
	</table>
</div>
<?php echo $this->Html->script('formInputs.js'); ?>