<?php

	include("../server/server.php");
	
	$task_id = get_post('task', 0);
	$comment = get_post('comment', '');

	$comment = strip_tags($comment, '<a><b><br>');
	
	if($comment == '' OR $comment == 'New comment..'){
		echo "Please enter a comment.";
		exit;
	}
	
	if($task_id != 0){
	
		$action = "new comment";
	
		$project_id = SQL_Single("SELECT project_id FROM tasks WHERE task_id = $task_id");
		$priority_id = SQL_Single("SELECT priority_id FROM tasks WHERE task_id = $task_id");
		$status_id = SQL_Single("SELECT status_id FROM tasks WHERE task_id = $task_id");
		$assigned_to = SQL_Single("SELECT assigned_to FROM tasks WHERE task_id = $task_id");
		$time_estimated = SQL_Single("SELECT time_estimated FROM tasks WHERE task_id = $task_id");
		$time_actual = SQL_Single("SELECT time_actual FROM tasks WHERE task_id = $task_id");
		
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
																		'$comment',
																		$project_id,
																		$priority_id,
																		$status_id,
																		$assigned_to,
																		$time_estimated,
																		$time_actual
																		
																		) ");
	
	}
	
	echo 1;
	
	include("../server/notifications.php");

?>