<?php

	include("./server.php");

	$bugs = SQL_Assoc("SELECT * FROM bug");
	
	foreach($bugs as $bug_array){
	
		$project_id = 1;
		$priority_id = $bug_array['priority'];
		$title = mysqli_real_escape_string($db_selected, $bug_array['title']);
		$comment = mysqli_real_escape_string($db_selected, $bug_array['description']);
		$status_id = $bug_array['state'];
		$created_by = $bug_array['created_by'];
		$timestamp = $bug_array['timestamp'];
		
		switch($priority_id){
			case "10":
				$priority_id = 1;
				break;
			case "20":
				$priority_id = 4;
				break;
			case "30":
				$priority_id = 5;
				break;
			default:
				$priority_id = 5;
				break;
			
		}
		
		switch($status_id){
			case "0":
				$status_id = 6;
				break;
			case "1":
				$status_id = 2;
				break;
			case "2":
				$status_id = 3;
				break;
			case "3":
				$status_id = 4;
				break;
			default:
				$status_id = 1;
				break;
		}
		
		$task_id = SQL_Generic("INSERT INTO tasks (

																project_id,
																priority_id,
																status_id,
																title,
																created_by,
																assigned_to,
																timestamp_created
																
																) VALUES (

																$project_id,
																$priority_id,
																$status_id,
																'$title',
																$created_by,
																1,
																'$timestamp'
																
																)
																
																");
																
															
		SQL_Generic("INSERT INTO comments (
																		
																		task_id,
																		user_id,
																		comment,
																		timestamp_created
																		
																		)
																		VALUES
																		(
																		
																		$task_id,
																		$created_by,
																		'$comment',
																		'$timestamp'
																		
																		)");
	
	}

?>
