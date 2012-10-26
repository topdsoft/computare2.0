<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Edit Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Menu Display Name'));
//		echo $this->Form->input('user_id');
//		echo $this->Form->input('Form');
		
//debug($this->data);
	?>
	<?php //echo '<h3>'.__($menu['Menu']['name']).'</h3>'; ?>
	<br><h2>Menu Links</h2>
	<table id='menutable'>
		<tr><th>Display Label</th><th>Form</th><th>Parameters</th><th></th></tr>
		<tr id="row0" style="display:none;">
			<td><?php echo $this->Form->input('unused.label',array('label'=>'','type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('unused.form_id',array('label'=>'','type'=>'select','options'=>$formlist)); ?></td>
			<td><?php echo $this->Form->input('unused.params',array('label'=>'','type'=>'text')); ?></td>
		</tr>
		<?php 
			$rows=0;
			foreach($this->data['Data'] as $d) {
				//output each form
				$rows++;
				echo '<tr id="row'.$rows.'">';
//				echo '<td>'.$form['FormsMenu']['name'].'</td>';
				echo '<td>'.$this->Form->input("Data.$rows.label",array('label'=>'','type'=>'text')).'</td>';
				echo '<td>'.$this->Form->input("Data.$rows.form_id",array('label'=>'','type'=>'select','options'=>$formlist)).'</td>';
				echo '<td>'.$this->Form->input("Data.$rows.params",array('label'=>'','type'=>'text')).'</td>';
				echo '</tr>';
			}//endforeach
		?>
		<tr id="trAdd"><td> <?php echo $this->Form->button('Add Link',array('type'=>'button','title'=>'Click Here to add another link','onclick'=>'addRow()')); ?> </td><td></td><td></td><td></td><td></td></tr>
	</table>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Menu.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Menu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php echo $this->Html->script(array('jquery-1.6.4.min'));?>
<script type='text/javascript'>
	var lastRow=<?php echo $rows; ?>;
	
	function addRow() {
		lastRow++;
		$("#menutable tbody>tr:#row0").clone(true).attr('id','row'+lastRow).removeAttr('style').insertBefore("#menutable tbody>tr:#trAdd");
//		$("#person"+lastRow+" button").attr('onclick','removePerson('+lastRow+')');
		$("#row"+lastRow+" input:first").attr('name','data[Data]['+lastRow+'][label]').attr('id','menuLabel'+lastRow);
		$("#row"+lastRow+" select").attr('name','data[Data]['+lastRow+'][form_id]').attr('id','menuFormId'+lastRow);
		$("#row"+lastRow+" input:last").attr('name','data[Data]['+lastRow+'][params]').attr('id','menuParams'+lastRow);
//		$("#person"+lastRow+" input:eq(2)").attr('name','data[Person]['+lastRow+'][email]').attr('id','personEmail'+lastRow);
	}
	
	function removePerson(x) {
		$("#person"+x).remove();
	}
</script>