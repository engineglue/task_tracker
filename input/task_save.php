<?php

	include("../server/server.php");

	$task_id = get_post('task', 0);
	$title = get_post('title', '');
	$project_id = get_post('project', 0);
	$priority_id = get_post('priority', 0);
	$status_id = get_post('status', 0);
	$assigned_to = get_post('assigned_to', 0);
	$time_estimated = get_post('estimate', 0);
	$time_actual = get_post('actual', 0);
	$override = get_post('override', 0);
	
	$title = strip_tags($title);
	
	$search_query = "";

	if($title == '' OR $title == 'Task short description'){
		echo "Please enter a short description for this task.";
		exit;
	}
	
	if($task_id == 0){

		//new task
		$action = "new task";
		
		//check if a similar task arleady exists
		if(!$override){

			$title_words = explode(' ', $title);
			
			$first = true;
			foreach($title_words as $title_word){

				if(strlen($title_word) > 5){

					if($first){

						$first = false;
						
						$search_query = "SELECT task_id FROM tasks WHERE title LIKE '%$title_word%' ";
						
					} else {
					
						$search_query .= "AND title LIKE '%$title_word%' ";
						
					}
					
				}
				
			}

			if($search_query){

				$direct_match = SQL_Single("SELECT task_id FROM tasks WHERE title LIKE '$title' ");

				if($direct_match){
				
					echo "This task may already exist. (see <a href='../../task/$direct_match/'>$direct_match</a>) You may choose to <span class='anchor' onclick='save_task(1);'>override</span>.";
					
					exit;
					
				}

				$similar_tasks = SQL_Array($search_query);

				if($similar_tasks){
					
					echo "This task may already exist. (see  ";
				
					foreach($similar_tasks as $similar_task_id){
					
						echo "<a href='../../task/$similar_task_id/'>$similar_task_id</a> ";
					
					}
					
					echo ") You may choose to <span class='anchor' onclick='save_task(1);'>override</span>.";
					
					exit;
					
				}
				
			}
			
		}

		//insert
		$task_id = SQL_Generic("INSERT INTO tasks (
																					project_id,
																					priority_id,
																					status_id,
																					title,
																					created_by,
																					assigned_to,
																					time_estimated,
																					time_actual
																					
																					) VALUES (
																					
																					$project_id,
																					$priority_id,
																					$status_id,
																					'$title',
																					$user->user_id,
																					$assigned_to,
																					$time_estimated,
																					$time_actual
																					
																					) ");

		$snapshot_comment = "Task created. ($title)";

	} else {

		//update task
		$action = "updated task";
		
		$previous_assigned_to = SQL_Single("SELECT assigned_to FROM tasks WHERE task_id = $task_id");
		$previous_status_id = SQL_Single("SELECT status_id FROM tasks WHERE task_id = $task_id");

		//update
		SQL_Generic("UPDATE tasks SET project_id = $project_id,
																priority_id = $priority_id,
																status_id = $status_id,
																title = '$title',
																assigned_to = $assigned_to,
																time_estimated = $time_estimated,
																time_actual = $time_actual,
																idle_time = 0
																	WHERE task_id = $task_id");
																	
		$snapshot_comment = "Task updated. ($title)";
		
		//add assignment log
		
	
	}

	//save snapshot
	SQL_Generic("INSERT INTO comments (
																	
																	task_id,
																	user_id,
																	comment,
																	project_id_snapshot,
																	priority_id_snapshot,
																	status_id_snapshot,
																	assigned_to_snapshot,
																	time_estimated_snapshot,
																	time_actual_snapshot
	
																	) VALUES (
																	
																	$task_id,
																	$user->user_id,
																	'$snapshot_comment',
																	$project_id,
																	$priority_id,
																	$status_id,
																	$assigned_to,
																	$time_estimated,
																	$time_actual
																	
																	) ");

	echo $task_id;

	//add log to assignment log
	if($action == "updated task"){

		//task closed or assigned to new user
		if($status_id == 6 OR $previous_assigned_to != $assigned_to){

			$last_assigned_to_time = strtotime(SQL_Single("SELECT MIN(timestamp_created) FROM comments WHERE task_id = $task_id and assigned_to_snapshot = $previous_assigned_to"));
			$duration = (time() - $last_assigned_to_time) / 3600;
		
			SQL_Generic("INSERT INTO assignment_log (
																					
																					user_id,
																					task_id,
																					status_id,
																					duration
																					
																					) VALUES (
																					
																					$previous_assigned_to,
																					$task_id,
																					$previous_status_id,
																					$duration
																					
																					)");
		
		}

	}
	
	include("../server/notifications.php");

?>
