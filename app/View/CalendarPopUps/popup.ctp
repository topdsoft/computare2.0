<?php echo $this->Form->create('Calendar'); ?>
<?php
	echo $this->Form->input('year_id',array('label'=>''));
	echo $this->Form->input('month_id',array('label'=>''));
?>
<table>
	<tr>
		<th>Wk</th>
		<?php foreach($days as $day) echo '<th>'.$day.'</th>'; ?>
	</tr>
	<tr>
	<?php
		echo '<td>'.$weekNumber.'</td>';
		//skip to first day of month
		for($i=0; $i<$firstDay;$i++) echo'<td></td>';
		$day=1;
		$dayOfWeek=$firstDay;
		while($day<=$daysInMonth) {
			//loop for all days in month
			echo "<td>$day</td>";
			$day++;
			$dayOfWeek++;
			if($dayOfWeek>6) {
				//sunday
				$dayOfWeek=0;
				echo '</tr>';
				$weekNumber++;
				echo "<td>$weekNumber</td>";
			}//endif
		}//end while
	?>
</table>

<?php
// debug($this);