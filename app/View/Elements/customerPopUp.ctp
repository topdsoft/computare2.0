<?php 
/**
 * customerPopUp.ctp
 * Used to show the customer finder popup
 * should be passed:
	* imputId=>the id of input element that will get the item.id user selects from the pop up
 */
?>
<span>

	<a href="#" onclick="window.open('<?php echo $this->Html->url(array('controller'=>'customerPopUps','action'=>'popup','inputId'=>$inputId)); ?>',
	'popup','width=500,height=600,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0');
	return false">Customer Finder</a>
</span>