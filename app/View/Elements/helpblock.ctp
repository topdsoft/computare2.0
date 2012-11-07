<?php

/**
 * helpblock.ctp is used to display the help index link as well as page specific help link
 */

	echo $this->Html->link(__('Help Index'),'/',array('target'=>'none'));
	if(isset($this->viewVars['formhelp'])) echo '<br>'.$this->Html->link(__('Page Help'),$this->viewVars['formhelp'],array('target'=>'none'));
?>