<div class="workflowChains form">
<?php echo $this->Form->create('WorkflowChain'); ?>
	<fieldset>
		<legend><?php echo __('Edit Workflow Chain'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('return_form');
		echo $this->Form->end(__('Submit'));
	?>
	</fieldset>
<?php 
// debug($this->data);
	if($this->data['Link']) {
		//show table of links
		echo '<h2>Links</h2>';
		echo '<table>';
		echo '<tr><th>Order</th><th>Controller</th><th>Action</th><th>Parameters</th><th></th></tr>';
		foreach($this->data['Link'] as $link) {
			//loop for all links
			echo '<tr>';
			echo '<td>'.$link['ordr'].'</td>';
			echo '<td>'.$link['controller'].'</td>';
			echo '<td>'.$link['action'].'</td>';
			echo '<td>'.$link['params'].'</td>';
			echo '<td class="actions">';
			echo $this->Html->link(__('Edit'),array('action'=>'editlink',$link['id']));
			echo $this->Html->link(__('Remove'),array('action'=>'removelink',$link['id']));
			echo '</td>';
			echo '</tr>';
		}//end foreach
		echo '</table>';
	}//endif
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Link'), array('action' => 'addlink',$this->data['WorkflowChain']['id'])); ?> </li>
	</ul>
</div>
