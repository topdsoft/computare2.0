<div class="menus view">
<?php echo $this->Form->create('Menu'); ?>
<h2><?php  echo __('Menu: ').h($menu['Menu']['name']); ?></h2>
<h3>Current Forms in Menu</h3>
<?php 
	foreach ($forms as $form){
		//loop for all menu items
		if($form['FormsMenu']['form_id']==0) {
			//this is a header
			echo '<strong>'.$form['FormsMenu']['name'].'</strong>';
		} else {
			//this is a link
			echo '<li>'.$this->Html->link($form['FormsMenu']['name'],$form['Form']['link'].'/'.$form['FormsMenu']['params']).'</li>';
		}//endif
	}//endforeach
	//show most visited
/*	echo '<br><h3>Most Visited Forms</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<th>Name</th><th>Group</th><th>Visits</th><th>Last Visit</th><th></th>';
	echo '</tr>';
	foreach($visits as $visit) {
		//loop for all visits
		echo '<tr>';
		echo '<td title="'.$visit['Form']['description'].'">'.$visit['Form']['name'].'</td>';
		echo '<td>'.$formGroups[$visit['Form']['formGroup_id']].'</td>';
		echo '<td>'.$visit['FormsUser']['visits'].'</td>';
		echo '<td>'.$visit['FormsUser']['modified'].'</td>';
		echo '</tr>';
	}//endforeach
	echo '</table>';
// debug($visits);*/
	echo $this->Form->input('formGroup_id');
	echo $this->Form->end('Submit');
?>
</div>
