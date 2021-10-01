<?php

	include("../server/server.php");
	
	$search = get_post('search', '');

	$search_where = get_user_detail($user->user_id, "search_where");

	$project = get_user_detail($user->user_id, "project_id");
	$priority = get_user_detail($user->user_id, "priority_id");
	$status = get_user_detail($user->user_id, "status_id");
	$created_by = get_user_detail($user->user_id, "created_by");
	$assigned_to = get_user_detail($user->user_id, "assigned_to");
	$order = get_user_detail($user->user_id, "order_tasks_by");
	$dont_show = get_user_detail($user->user_id, "dont_show");

	$search_sql = "";
	$project_sql = "";
	$priority_sql = "";
	$status_sql = "";
	$created_by_sql = "";
	$assigned_to_sql = "";
	$dont_show = "";
	$order_by_sql = "";

	if(is_numeric($search)){
		$search_id = " OR task_id = $search ";
	} else {
		$search_id = "";
	}
	
	if($search_where == 'title_comments'){
		$search_sql = "WHERE tasks.task_id IN (SELECT task_id FROM tasks WHERE title LIKE '%$search%' OR task_id IN (SELECT task_id FROM comments WHERE comment LIKE '%$search%' $search_id) $search_id) ";
	}
	
	if($search_where == 'title'){
		$search_sql = "WHERE tasks.title LIKE '%$search%' $search_id ";
	}
	
	if($search_where == 'comments'){
		$search_sql = "WHERE tasks.task_id IN (SELECT task_id FROM comments WHERE comment LIKE '%$search%' $search_id) ";
	}

	if($project != 0){
		$project_sql = "AND tasks.project_id = '$project' ";
	}
	
	if($priority != 0){
		$priority_sql = "AND tasks.priority_id = '$priority' ";
	}
	
	if($status != 0){
		$status_sql = "AND tasks.status_id = '$status' ";
	}
	
	if($created_by != 0){
		$created_by_sql = "AND tasks.created_by = '$created_by' ";
	}

	if($assigned_to != 0){
		$assigned_to_sql = "AND tasks.assigned_to = '$assigned_to' ";
	}

	if($order){
		switch($order){
		
			case "idle_time":
				$order_by_sql = "ORDER BY $order DESC";
				break;
				
			default:
				$order_by_sql = "ORDER BY $order ASC";
				break;
		
		}
	} else {
		$order_by_sql = "";
	}
	
	if($dont_show != 0){
		$dont_show = "AND tasks.status_id != $dont_show ";
	} else {
		$dont_show = "";
	}

	$tasks = SQL_Assoc("SELECT tasks.task_id, tasks.project_id, tasks.priority_id, tasks.status_id, tasks.title, tasks.time_estimated, tasks.idle_time, projects.project, priorities.priority, status.status FROM tasks 
											LEFT JOIN projects ON tasks.project_id = projects.project_id
											LEFT JOIN priorities ON tasks.priority_id = priorities.priority_id
											LEFT JOIN status ON tasks.status_id = status.status_id
											$search_sql
											$project_sql
											$priority_sql
											$status_sql
											$created_by_sql
											$assigned_to_sql
											$dont_show
											$order_by_sql
											");

	// $priorities = SQL_Array("SELECT priority_id FROM priorities ORDER BY order_by DESC");
	
	// $priority_opacity = 1;
	
	// foreach($priorities as $priority_id){
	
		// $priority_opacities[$priority_id] = $priority_opacity;

		// $priority_opacity = $priority_opacity - 0.1;
	
	// }
	
	$status_colors_dim = SQL_Dimen("SELECT status_id, color FROM status_colors WHERE user_id = $user->user_id");
	
	if($status_colors_dim){
		foreach($status_colors_dim as $status_color_array){
		
			$status_colors[$status_color_array[0]] = $status_color_array[1];
		
		}
	}

	if($tasks){
	
		echo "<table style='width:100%;'>";
		
		echo "<tr>";
		echo "<td width='5%'>Task</td>";
		echo "<td width='15%'>Project</td>";
		echo "<td width='8%'>Priority</td>";
		echo "<td width='15%'>Status</td>";
		echo "<td width='43%'>Title</td>";
		echo "<td width='7%'>Estimate</td>";
		echo "<td width='7%'>Idle</td>";
		echo "</tr>";
		
		foreach($tasks as $task_array){
		
			$task_id = $task_array['task_id'];
			$task_project_id = $task_array['project_id'];
			$task_project = $task_array['project'];
			$task_priority_id = $task_array['priority_id'];
			$task_priority = $task_array['priority'];
			$task_status_id = $task_array['status_id'];
			$task_status = $task_array['status'];
			$task_title = stripslashes($task_array['title']);
			$task_estimate = $task_array['time_estimated'];
			$task_idle_time = $task_array['idle_time'];

			$opacity = 1;//$priority_opacities[$task_priority_id];
			
			if($status_colors[$task_status_id]){
				$color = $status_colors[$task_status_id];
			} else {
				$color = 'blue';
			}
			
			if($task_estimate != 0){
				$task_estimate .= " hours";
			} else {
				$task_estimate = "";
			}
			
			if($task_idle_time != 0){
				if($task_idle_time == 1){
					$task_idle_time .= " day";
				} else {
					$task_idle_time .= " days";
				}
			} else {
				$task_idle_time = "";
			}
			
			$anchor = "../../task/$task_id/";
			
			echo "<tr>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_id</a></d>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_project</a></d>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_priority</a></d>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_status</a></d>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_title</a></td>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_estimate</a></d>";
			echo "<td><a href='$anchor' style='color:#$color;opacity:$opacity;'>$task_idle_time</a></d>";
			echo "</tr>";
		
		}
		
		echo "</table>";
		
	} else {
		echo "<div style='margin:10px 0px 0px 2px;'>No tasks found.</div>";
	}
	
	exit;
	
?>
