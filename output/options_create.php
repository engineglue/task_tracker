<?php

	include("../server/server.php");
	
	if(isset($_POST['option'])){
		$option = $_POST['option'];
	} else {
		exit;
	}
	
	$task_id = get_post('task', 0);

	switch($option){
	
		case "project":
			$options = SQL_Dimen("SELECT project_id, project FROM projects ORDER BY order_by");
			$selected_option = SQL_Single("SELECT project_id FROM tasks WHERE task_id = $task_id");
			break;
			
		case "priority":
			$options = SQL_Dimen("SELECT priority_id, priority FROM priorities ORDER BY order_by");
			$selected_option = SQL_Single("SELECT priority_id FROM tasks WHERE task_id = $task_id");
			break;
			
		case "status":
			$options = SQL_Dimen("SELECT status_id, status FROM status ORDER BY order_by");
			$selected_option = SQL_Single("SELECT status_id FROM tasks WHERE task_id = $task_id");
			break;
			
		case "created_by":
			$options = SQL_Dimen("SELECT user_id, username FROM users ORDER BY username");
			$selected_option = SQL_Single("SELECT created_by FROM tasks WHERE task_id = $task_id");
			$precursor = "Created by ";
			break;
			
		case "assigned_to":
			$options = SQL_Dimen("SELECT user_id, username FROM users ORDER BY username");
			$selected_option = SQL_Single("SELECT assigned_to FROM tasks WHERE task_id = $task_id");
			$precursor = "Assign to ";
			break;

	}

	if($options){

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