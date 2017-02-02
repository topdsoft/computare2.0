<div class="salesOrders form">
<?php echo $this->Form->create('SalesOrderDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Service to Sales Order: ').$this->Form->value('SalesOrder.id'); ?></legend>
	<?php
// if(isset($service)) debug($service);
		echo "<p>Customer: ".$this->Html->link($this->data['Customer']['name'],array('controller'=>'customers','action'=>'view',$this->data['Customer']['id'])).'</p>';
		echo '<p>Sales Order Type: <strong title="'.$this->data['SalesOrderType']['description'].'">'.$this->data['SalesOrderType']['name'].'</strong></p>';
		if(isset($service)) {
			//show qty
			if($service['Service']['pricing']=='U') $label='Units';
			elseif($service['Service']['pricing']=='Q') $label='Qty';
			else $label='Hours';
			echo $this->Form->input('service_id',array('disabled'=>true));
			echo $this->Form->input('service_id',array('type'=>'hidden'));
			echo $this->Form->input('qty',array('label'=>$label,'id'=>'sc'));
			if($service['Service']['fixedRate']){ 
				//fixed rate
				echo $this->Form->input('price',array('label'=>'Rate (fixed)','disabled'=>true));
				echo $this->Form->input('price',array('type'=>'hidden'));
			} else echo $this->Form->input('price',array('label'=>'Rate'));
		} else {
			//show service selection
			echo $this->Form->input('service_id',array('id'=>'sc'));
		}//endif
	?>
	<table>
	<tr><th>Project</th><th>Task</th><th>User</th><th>Created</th><th>Duration</th><th>Notes</th></tr>
	<?php
		foreach($timeRecords as $timeRecord) {
			//loop for all time records and add to table
			echo '<tr>';
			echo '<td>'.$projects[$timeRecord['Task']['project_id']].'</td>';
			echo '<td>'.$timeRecord['Task']['name'].'</td>';
			echo '<td>'.$timeRecord['User']['username'].'</td>';
			echo '<td>'.$timeRecord['TimeRecord']['created'].'</td>';
			echo '<td>'.$timeRecord['TimeRecord']['duration'].'</td>';
			echo '<td>'.$timeRecord['TimeRecord']['notes'].'</td>';
			echo '</tr>';
		}//end foreach $timerecord
	?>
	</table>
	<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
</div>
<script type='text/javascript'>document.getElementById('sc').focus();</script>