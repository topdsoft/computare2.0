<fieldset><legend id="filterTitle" title="Click to hide/show fitlers">Filters</legend>
<div id="filters">
<table>
<tr>
<?php

//debug($filterData);
	//filterblock.ctp used to display filter inputs in a view
	foreach($filterData as $filter) {
		//loop for all requested filters
		echo '<td>';
		if($filter['type']==1) {
			//list
			echo $this->Form->input('Filter.'.$filter['passName'],array('options'=>$filter['options'],'multiple'=>'true','label'=>$filter['label']));
		}//endif type==1 list
		if($filter['type']==2) {
			//value range
			echo $this->Form->input('Filter.'.$filter['passName'].'.min',array('label'=>$filter['label'].' Min'));
			echo $this->Form->input('Filter.'.$filter['passName'].'.max',array('label'=>$filter['label'].' Max'));
		}//endif type==2 value range
		if($filter['type']==4) {
			//TF checkbox
			echo $this->Form->input('Filter.'.$filter['passName'],array('type'=>'checkbox','label'=>$filter['label']));
		}//endif type==4 (TF checkbox)
		echo '</td>';
	}//end foreach
	
?>
</tr>
</table>
<?php echo $this->Html->link(__('Clear All fitlers'),array('action'=>$this->view)); //debug($this)?>
<?php echo $this->Form->end(__('Set Filters')); ?>
</div>
</fieldset>
<?php echo $this->Html->script('filters.js') ?>