<?php

	include("../server/server.php");
	
	$task_id = get_post('task', '');

	$comments = SQL_Assoc("SELECT * FROM comments WHERE task_id = $task_id ORDER BY timestamp_created DESC");
	
	if($comments){
	
		foreach($comments as $comment_array){
		
			$username = ucfirst(SQL_Single("SELECT username FROM users WHERE user_id = ".$comment_array['user_id']));
			$timestamp = date("g:i a - n/j/Y", strtotime($comment_array['timestamp_created']));
			$project = SQL_Single("SELECT project FROM projects WHERE project_id = ".$comment_array['project_id_snapshot']);
			$priority = SQL_Single("SELECT priority FROM priorities WHERE priority_id = ".$comment_array['priority_id_snapshot']);
			$status = SQL_Single("SELECT status FROM status WHERE status_id = ".$comment_array['status_id_snapshot']);
			$assigned_to_name = ucfirst(SQL_Single("SELECT username FROM users WHERE user_id = ".$comment_array['assigned_to_snapshot']));
			$time_estimated = $comment_array['time_estimated_snapshot'];
			$time_actual = $comment_array['time_actual_snapshot'];
			
			if($time_estimated){
				$time_estimated = "- $time_estimated hours estimated";
			}
			
			if($time_actual){
				$time_actual = "- $time_actual hours actual";
			}
			
			$snapshot = "$project - $priority - $status - Assigned to $assigned_to_name $time_estimated $time_actual";
			
			echo "<div class='comment_outer'><div class='comment_inner'>";
			
			echo $comment_array['comment'];
			
			echo "<br><br><b>$username</b> - $timestamp - ".$snapshot;
			
			echo "</div></div>";
		
		}
	
	} else {
	
		echo "No comments.";
	
	}

	
	exit;
	
?>