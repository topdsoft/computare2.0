<?php 
//debug($this->Session->read('Menu'));
	//get user menu info from Session
	$menus=$this->Session->read('Menu');
	if($menus){
	//confirm there are menus
		foreach($menus as $menu) {
			//loop for each menu
			echo '<li>';
			echo $this->Html->link($menu['name'],array('controller'=>'menus','action'=>'view',$menu['id']));
			echo '<ul>';
			foreach($menu['Form'] as $form) {
				//loop for each form (or link) and add it to the menu
				if($form['action']) {
					//this is a link
					echo '<li>';
	//				echo $this->Html->link($form['name'],$form['link'].'/'.$form['params']);
					echo $this->Html->link($form['name'],array('controller'=>$form['controller'],'action'=>$form['action'],$form['params']));
				} else {
					//this is not a link
					echo '<li style="border-bottom: 1px solid #999;">';
					echo $form['name'];
				}//endif
				echo '</li>';
			}//end foreach link
			echo '</ul>';
			echo '</li>';
		}//endforeach menus
	}//endif
?>