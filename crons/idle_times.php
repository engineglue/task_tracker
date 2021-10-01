<?php

	$tasks = SQL_Array("SELECT task_id FROM tasks WHERE status_id != 6");

	foreach($tasks as $task_id){
		
		$latest_comment_date = strtotime(SQL_Single("SELECT MAX(timestamp_created) FROM comments WHERE task_id = $task_id"));
		
		$idle_time = (time() - $latest_comment_date) / 3600 / 24;
		
		SQL_Generic("UPDATE tasks SET idle_time = $idle_time WHERE task_id = $task_id");

	}
	
	//clear production verifieds
	SQL_Generic("UPDATE tasks SET idle_time = 0 WHERE status_id = 6");
	
?>