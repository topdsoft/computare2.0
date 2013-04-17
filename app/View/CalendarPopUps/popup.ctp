<?php echo $this->Form->create('Calendar'); ?>
<table>
<?php
	echo '<tr><td class="plain" colspan="8">'.$this->Form->input('year_id',array(
		'label'=>'',
		'before'=>$this->Html->link('<',array($year-1,$month)),
		'after'=>$this->Html->link('>',array($year+1,$month)),
		'onclick'=>'year()',
	)).'</td></tr>';
	if($month==1)$back=array($year-1,12);
	else $back=array($year,$month-1);
	if($month==12)$forward=array($year+1,1);
	else $forward=array($year,$month+1);
	echo '<tr><td class="plain" colspan="8">'.$this->Form->input('month_id',array(
		'label'=>'',
		'before'=>$this->Html->link('<',$back),
		'after'=>$this->Html->link('>',$forward),
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
			$class='';
			if($day==$today) $class=' class="today" title="Today"';
			echo "<td$class><a href='#'>$day<a></td>";
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
// debug($this);
?>

<script type='text/javascript'>
	function year() {
		var year=$("#CalendarYearId").val();
		var month=<?php echo $month;?>;
		alert(month);
	}
	
	function month() {
		var month=$("#CalendarMonthId").val();
		var year=<?php echo $year;?>;
// 		alert(month);
		self.close();
	}
	
</script>