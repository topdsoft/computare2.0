<?php 
/**
 * requires: $data['revisions'] structure
 * $users is array of users
 * $ignore array optional for fields to leave off
 */
//debug($data);
	if(count($data['Revisions'])>1) {
		//show revisions
//		$ignore=array('id','created','created_id');
		echo'<br><h3>Revisions</h3>';
		foreach($data['Revisions'] as $i=>$revision) {
			//loop for each revision
			if($i>0) {
				//skip first revision since it is the current data
				echo "<p>Made: {$revision['created']} by: ".$users[$revision['created_id']].'</p>';
				echo '<dl>';
				foreach($revision as $label=>$value) {
					//loop for all label => value pair and check for differences
					if(!in_array($label,$ignore) && $value!=$data['Revisions'][$i-1][$label]) {
						//show difference
						$newValue=$data['Revisions'][$i-1][$label];
						if(empty($value)) $value='<i>(empty)</i>';
						if(empty($newValue)) $newValue='<i>(empty)</i>';
						echo "<dt>$label from</dt><dd>$value</dd>";
						echo "<dt>$label to</dt><dd>$newValue</dd>";
					}//endif
				}//end foreach $revision
				echo '</dl><br>';
			}//endif
		}//endforeach $customer['Revisions']
	}//endif
?>