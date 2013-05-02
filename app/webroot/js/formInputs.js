//app/webroot/js/formInputs.js

//<!--
$(function(){
	//hide message
	$("#flashMessage.notice").fadeTo(0,0);
	
	$("input").keypress( function(){
		$(this).attr('style','background:#ffcc00');
		$("#flashMessage.notice").fadeTo(500,1);
	});
})


//-->