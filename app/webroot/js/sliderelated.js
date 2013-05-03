//app/webroot/js/sliderelated.js

//<!--
$(function(){
	//show-hide related tables
	$(".related h3").click( function(){
		$(this).parent().children().not(":eq(0)").slideToggle();
	});
})


//-->