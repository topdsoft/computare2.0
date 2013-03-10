<div class="reportheader">
<?php
	//general info
	echo 'Report Date: '.date('Y-m-d H:m:s');
	echo '&nbsp&nbsp User: '.$this->Session->read('Auth.User.username');
	//show filter details
	foreach($filterDetails as $fd) {
		//loop and display all details of filters used
		echo '<br>'.$fd;
	}//end foreach
?></div>