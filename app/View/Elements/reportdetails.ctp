<?php
	echo 'Report Date: '.date('Y-m-d H:m:s');
	echo '&nbsp&nbsp User: '.$this->Session->read('Auth.User.username');
?>