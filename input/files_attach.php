<?php

	include("../server/server.php");
	
	$task_id = get_post('task', 0);
	
	$files = $_FILES['files'];
	
	$uploaded = false;
	
	$snapshot_comment = "Attachments uploaded.<br>";
	
	if(isset($files['tmp_name'])) {

		chdir('..');
		
		$root_directory = getcwd();
	
		$new_directory = date("Ymd");
	
		$target_directory = "$root_directory/upload/$new_directory/";
		
		if(!is_dir($target_directory)){
			mkdir($target_directory);
		}
	
		if(is_array($files['tmp_name'])) {
			foreach ($files['tmp_name'] as $key => $val) {
			
				$file_path = $files['tmp_name'][$key];

				$file_name = preg_replace('#[^A-Za-z0-9- ./]#', '', trim(strip_tags($files['name'][$key])));
				
				$path_parts = pathinfo($file_name);
				
				$file_extension = $path_parts['extension'];
				
				$micro_seconds_since_midnight = round(microtime(true) - strtotime("00:00"), 4);

				$file_name_new = $micro_seconds_since_midnight . "-" . rand(1000, 9999) . "." . $file_extension;
				
				$file_path_new = $target_directory . $file_name_new;

				if(move_uploaded_file($file_path, $file_path_new)){
				
					$uploaded = true;
					
					$file_name = mysqli_real_escape_string($db_selected, $file_name);
					
					$file_path_usable = mysqli_real_escape_string($db_selected, "../../upload/$new_directory/$file_name_new");
					
					//save in database
					SQL_Generic("INSERT INTO attachments (task_id, attachment, file_path) VALUES ($task_id, '$file_name', '$file_path_usable') ");
					
					//save snapshot
					$snapshot_comment .= "<br><a href='$file_path_usable'>$file_name</a>";

				}
			}
		}
		
		if($uploaded){
		
			$action = "new comment";
		
			//save snapshot
		
			$project_id = SQL_Single("SELECT project_id FROM tasks WHERE task_id = $task_id");
			$priority_id = SQL_Single("SELECT priority_id FROM tasks WHERE task_id = $task_id");
			$status_id = SQL_Single("SELECT status_id FROM tasks WHERE task_id = $task_id");
			$assigned_to = SQL_Single("SELECT assigned_to FROM tasks WHERE task_id = $task_id");
			$time_estimated = SQL_Single("SELECT time_estimated FROM tasks WHERE task_id = $task_id");
			$time_actual = SQL_Single("SELECT time_actual FROM tasks WHERE task_id = $task_id");
			
			$snapshot_comment = mysqli_real_escape_string($db_selected, $snapshot_comment);
			
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
		
		}
		
	}
	
	include("../server/notifications.php");
	
	header("Location: ../../task/$task_id/");

?>
