<?php

	include("../server/server.php");
	
	$task_id = get_post('task', 0);

	if($task_id != 0){
	
		echo SQL_Single("SELECT time_actual FROM tasks WHERE task_id = $task_id");
	
	} else {
	
		echo 0;
	
	}

?>