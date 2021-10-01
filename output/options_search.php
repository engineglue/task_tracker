<?php

	include("../server/server.php");
	
	if(isset($_POST['option'])){
		$option = $_POST['option'];
	} else {
		exit;
	}
	
	$options = array();
	$selected_option = "";
	$selection_name = "";
	$precursor = "";
	
	switch($option){
	
		case "search_where":
			$options[] = array("title", "Search title");
			$options[] = array("comments", "Search comments");
			$options[] = array("title_comments", "Title and comments");
			$selected_option = SQL_Single("SELECT search_where FROM users WHERE user_id = $user->user_id");
			break;
	
		case "project":
			$options = SQL_Dimen("SELECT project_id, project FROM projects ORDER BY order_by");
			$selected_option = SQL_Single("SELECT project_id FROM users WHERE user_id = $user->user_id");
			$selection_name = "All projects ";
			break;
			
		case "priority":
			$options = SQL_Dimen("SELECT priority_id, priority FROM priorities ORDER BY order_by");
			$selected_option = SQL_Single("SELECT priority_id FROM users WHERE user_id = $user->user_id");
			$selection_name = "All priorities ";
			break;
			
		case "status":
			$options = SQL_Dimen("SELECT status_id, status FROM status ORDER BY order_by");
			$selected_option = SQL_Single("SELECT status_id FROM users WHERE user_id = $user->user_id");
			$selection_name = "Show statuses ";
			$precursor = "Show ";
			break;
			
		case "dont_show":
			$options = SQL_Dimen("SELECT status_id, status FROM status ORDER BY order_by");
			$selected_option = SQL_Single("SELECT dont_show FROM users WHERE user_id = $user->user_id");
			$selection_name = "Don't show statuses";
			$precursor = "Don't show ";
			break;
			
		case "created_by":
			$options = SQL_Dimen("SELECT user_id, username FROM users ORDER BY username");
			$selected_option = SQL_Single("SELECT created_by FROM users WHERE user_id = $user->user_id");
			$selection_name = "Created by anyone";
			$precursor = "Created by ";
			break;
			
		case "assigned_to":
			$options = SQL_Dimen("SELECT user_id, username FROM users ORDER BY username");
			$selected_option = SQL_Single("SELECT assigned_to FROM users WHERE user_id = $user->user_id");
			$selection_name = "Assigned to anyone";
			$precursor = "Assigned to ";
			break;
			
		case "order_by":
			$options[] = array("task_id", "Order by task");
			$options[] = array("project_id", "Order by project");
			$options[] = array("priority_id", "Order by priority");
			$options[] = array("status_id", "Order by status");
			$options[] = array("title", "Order by title");
			$options[] = array("time_estimated", "Order by estimate");
			$options[] = array("idle_time", "Order by idle time");
			$selected_option = SQL_Single("SELECT order_tasks_by FROM users WHERE user_id = $user->user_id");
			break;
		
	}

	if($options){
	
		if($selection_name){
			echo "<option value=''>$selection_name</option>";
		}
		
		foreach($options as $option_array){

			$option_id = $option_array[0];
			$option_name = ucfirst($option_array[1]);
			
			$selected = "";
			if($option_id == $selected_option){
				$selected = "SELECTED";
			}

			echo "<option value='$option_id' $selected>$precursor$option_name</option>";
		
		}
		
	} else {
	
		echo "<option value=''>No options</option>";
	
	}
	
	exit;
	
?>
