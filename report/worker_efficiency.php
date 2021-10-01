<?php

	include("../server/server.php");
	
	$username = get_switch('username', '');
	
	$user_id = SQL_Single("SELECT user_id FROM users WHERE username LIKE '$username' ");
	
	if($user_id){
		
		//task_title, assignment, duration 
		$assignment_logs = SQL_Assoc("SELECT task_id, status_id, duration FROM assignment_log WHERE user_id = $user_id");
		
		if($assignment_logs){
		
			echo "<table>";
			
			echo "<tr>";
			echo "<td>Task</td>";
			echo "<td>Status</td>";
			echo "<td>Duration</td>";
			echo "</tr>";
			
			foreach($assignment_logs as $assignment_array){
			
				$task_id = $assignment_array['task_id'];
				$status_id = $assignment_array['status_id'];
				$duration = $assignment_array['duration'];
				
				$title = SQL_Single("SELECT title FROM tasks WHERE task_id = $task_id ");
				$status = SQL_Single("SELECT status FROM status WHERE status_id = $status_id ");
				
				if($duration != 0){
					$duration .= " hours";
				} else {
					$duration = "";
				}
			
				echo "<tr>";
				echo "<td>$title</td>";
				echo "<td>$status</td>";
				echo "<td>$duration</td>";
				echo "</tr>"; 
			
			}
			
			echo "</table>";
		
		} else {
		
			echo "No report.";
		
		}
		
	} else {
	
		echo "Incorrect username.";
	
	}
	
?>