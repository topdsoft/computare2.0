//app/webroot/js/menu.js

//<!--
$(function(){
	//hide sub menus
	$("#navigation li ul").hide();
	
	//show drop down
	$("#navigation li").hover( function(){
		$('ul', this).slideDown();
	},
		function() {
			$('ul', this).slideUp();
		}
	);
	
	//click to lower menu
//	$("#menu ul li").click( function(){
//		$('#menu:visible ul li ul').hide();
//		$('ul', this).slideDown();
//	})
})


//-->