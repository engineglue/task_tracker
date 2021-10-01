<?php

	include("../server/server.php");

	$search_where = get_post('search_where', 'title_comments');
	$project = get_post('project', '');
	$priority = get_post('priority', '');
	$status = get_post('status', '');
	$created_by = get_post('created_by', '');
	$assigned_to = get_post('assigned_to', '');
	$order = get_post('order_by', '');
	$dont_show = get_post('dont_show', '');
	
	//save as settings for user
	if($project == ''){
		$project = 0;
	}
	
	if($priority == ''){
		$priority = 0;
	}
	
	if($status == ''){
		$status = 0;
	}
	
	if($created_by == ''){
		$created_by = 0;
	}
	
	if($assigned_to == ''){
		$assigned_to = 0;
	}
	
	if($dont_show == ''){
		$dont_show = 0;
	}
	
	SQL_Generic("UPDATE users SET search_where = '$search_where',
															project_id = $project,
															priority_id = $priority,
															status_id = $status,
															created_by = $created_by,
															assigned_to = $assigned_to,
															order_tasks_by = '$order',
															dont_show = $dont_show
															WHERE user_id = $user->user_id
															");
	
	exit;
	
?>