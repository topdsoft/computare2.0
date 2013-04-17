<div class="menus view">
<h2><?php  echo h($menuName); ?></h2>
<?php 
//debug($forms);
	foreach ($forms as $form){
		//loop for all menu items
		if($form['FormsMenu']['form_id']==0) {
			//this is a header
			echo '<h3>'.$form['FormsMenu']['name'].'</h3>';
		} else {
			//this is a link
			echo '<li>'.$this->Html->link($form['FormsMenu']['name'],$form['Form']['link'].'/'.$form['FormsMenu']['params']).'</li>';
		}//endif
	}//endforeach
?>
</div>
