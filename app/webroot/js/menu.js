//app/webroot/js/menu.js

//<!--
$(function(){
	//hide sub menus
	$("#navigation li ul").hide();
	
	//show drop down
	$("#navigation li").hover( function(){
		$('ul', this).slideDown(150);
	},
		function() {
			$('ul', this).slideUp(150);
		}
	);
	
	//click to lower menu
//	$("#menu ul li").click( function(){
//		$('#menu:visible ul li ul').hide();
//		$('ul', this).slideDown();
//	})
})


//-->