<div class="pages index">
<?php //echo $this->Form->create('Page');?>

<h2>computāre Help Index</h2>
<?php
	//show all pages
	foreach($helpdata as $i=>$data) {
		//loop for all entries
		echo '<p>';
		//link to show/hide
		echo "<button id='button$i' onclick='showlink($i)'>+</button> ";
		echo $this->Html->link(__(($i+1).' '.$data['name']),array('action'=>'',$data['id']),array('style'=>'font-size: 120%;'));
		echo "<span class='links' id='link$i'>";
		//loop for all anchors
		$j=1;
		foreach ($data['anchors'] as $ai=>$anchor) echo '<br>&nbsp'.$this->Html->link(__(($i+1).'.'.($j++).' '.$anchor),array('#'=>$ai,'action'=>'',$data['id']));
		echo '</span></p>';
	}
?>

</div>

<script type="text/javascript">
//<!--

$(document).ready(function() {
	// do stuff when DOM is ready
//  	$(".pages p :not(:first-child)").hide();
	$(".pages .links").hide();
//	$("#mainH1").css("background-image",'url(img/tdslogo/tds_logo_1.png)');
//	$("#mainH1-1").hide();
});

function showlink($i) {
	$(".pages #link"+$i).show();
	$("#button"+$i).text('-');
	$("#button"+$i).attr('onclick','hidelink('+$i+')');
}

function hidelink($i) {
	$(".pages #link"+$i).hide();
	$("#button"+$i).text('+');
	$("#button"+$i).attr('onclick','showlink('+$i+')');
}

/*$(".show").click(function(){
	$(this).findnext(".links").show();
});
$(".pages a").mouseover(function(){
	//show hidden links
	$(this).nextUntil('p').show();
}).mouseleave(function(){
	$(this).nextUntil('p').hide();
});*/

//-->
</script>