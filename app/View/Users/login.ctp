<?php
	echo $this->Form->create('User');
	echo $this->Form->input('company',array('id'=>'sc','class'=>'required'));    
	echo $this->Form->input('username');    
	echo $this->Form->input('password');    
	echo $this->Form->end('Login');
?>
<script type='text/javascript'>document.getElementById('sc').focus();</script>