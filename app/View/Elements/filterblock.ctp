<fieldset><legend id="filterTitle" title="Click to hide/show fitlers">Filters</legend>
<div id="filters">

<?php

//debug($filterData);
	//filterblock.ctp used to display filter inputs in a view
	foreach($filterData as $filter) {
		//loop for all requested filters
		if($filter['type']==4) {
			//TF checkbox
			echo $this->Form->input('Filter.'.$filter['passName'],array('type'=>'checkbox','label'=>$filter['label']));
		}//endif type==4 (TF checkbox)
	}//end foreach
	
?>
</div>
</fieldset>
<?php echo $this->Form->end(__('Set Filters')); ?>
