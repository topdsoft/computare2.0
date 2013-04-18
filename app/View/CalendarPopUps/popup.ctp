<?php echo $this->Form->create('Calendar'); ?>
<table>
<?php
// debug($this->request->params['named']);
	echo '<tr><td class="plain" colspan="8">'.$this->Form->input('year_id',array(
		'label'=>'',
		'before'=>$this->Html->link('<',array_merge(array($year-1,$month),$this->request->params['named'])),
		'after'=>$this->Html->link('>',array_merge(array($year+1,$month),$this->request->params['named'])),
		'onclick'=>'year()',
	)).'</td></tr>';
	if($month==1)$back=array($year-1,12);
	else $back=array($year,$month-1);
	if($month==12)$forward=array($year+1,1);
	else $forward=array($year,$month+1);
	echo '<tr><td class="plain" colspan="8">'.$this->Form->input('month_id',array(
		'label'=>'',
		'before'=>$this->Html->link('<',array_merge($back,$this->request->params['named'])),
		'after'=>$this->Html->link('>',array_merge($forward, $this->request->params['named'])),
		'onclick'=>'month()',
	)).'</td></tr>';
?>
	<tr>
		<th>Wk</th>
		<?php foreach($days as $day) echo '<th>'.$day.'</th>'; ?>
	</tr>
	<tr>
	<?php
		echo '<td class="week">'.$weekNumber.'</td>';
		//skip to first day of month
		for($i=0; $i<$firstDay;$i++) echo'<td></td>';
		$day=1;
		$dayOfWeek=$firstDay;
		while($day<=$daysInMonth) {
			//loop for all days in month
			$class=' class="clickable"';
			if($day==$today) $class=' class="today clickable" title="Today"';
			echo "<td$class onclick='selectDay($day)'><a>$day<a></td>";
			$day++;
			$dayOfWeek++;
			if($dayOfWeek>6 && $day<=$daysInMonth) {
				//sunday
				$dayOfWeek=0;
				echo '</tr>';
				$weekNumber++;
				if($weekNumber<10) $weekNumber='0'.$weekNumber;
				echo "<td class=\"week\">$weekNumber</td>";
			}//endif
		}//end while
	?>
</table>

<?php
// debug($this->webroot.$this->params['controller'].'/'.$this->params['action']);
?>

<script type='text/javascript'>
	function year() {
		//set selected year and redirect
		var year=$("#CalendarYearId").val();
		window.location.replace('<?php echo $this->webroot.$this->params['controller'].'/'.$this->params['action'];?>/'+year+'/<?php 
				echo $month;
				foreach($this->request->params['named'] as $i=>$a) echo "/$i:$a";
			?>');
	}
	
	function month() {
		//get selected month and redirect
		var month=$("#CalendarMonthId").val();
		window.location.replace('<?php echo $this->webroot.$this->params['controller'].'/'.$this->params['action']."/$year/"; ?>'+month
			+'<?php
				foreach($this->request->params['named'] as $i=>$a) echo "/$i:$a";
			?>');
	}
	
	function selectDay(day) {
		//user has clicked on a day, return to previous form
		var toReturn='<?php echo"$year-$month" ?>-'+day;
		opener.document.getElementById('<?php echo $this->request->params['named']['inputId']; ?>').value=toReturn;
		self.close();
		
// alert(toReturn);
	}
	
</script>