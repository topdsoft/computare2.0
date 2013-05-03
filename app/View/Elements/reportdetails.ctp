<div class="reportheader">
<?php
	//general info
	echo 'Report Date: '.date('Y-m-d H:m:s');
	echo '&nbsp&nbsp By User: '.$this->Session->read('Auth.User.username');
	if(isset($filterDetails)){
		//show filter details
		foreach($filterDetails as $fd) {
			//loop and display all details of filters used
			echo '<br>'.$fd;
		}//end foreach
	}//endif
?></div>