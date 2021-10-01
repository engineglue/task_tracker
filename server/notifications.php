<?php

	//server will be including by supporting script
	
	//new task
	//updated task
	//new comment
	
	$users_to_notify = "";
	
	$task_commenters = SQL_Array("SELECT user_id FROM comments WHERE task_id = $task_id");
	
	if($action == 'new task'){
	
		$users_to_notify = SQL_Array("SELECT user_id FROM users WHERE notification_task_created = 1");
	
	}
	
	if($action == 'updated task'){
	
		$task_user_id = SQL_Single("SELECT assigned_to FROM tasks WHERE task_id = $task_id");
	
		$notify_user = SQL_Single("SELECT notification_my_task_changed FROM users WHERE user_id = $task_user_id");
		
		if($notify_user){
			$users_to_notify[] = $task_user_id;
		}
		
		if($task_commenters){
			foreach($task_commenters as $user_id){
				
				$notify_user_on_change = SQL_Single("SELECT notification_task_changed FROM users WHERE user_id = $user_id");

				if($notify_user_on_change){
					$users_to_notify[] = $user_id;
				}
				
			}
		}
		
	}
	
	if($action == 'new comment'){
	
		$task_user_id = SQL_Single("SELECT assigned_to FROM tasks WHERE task_id = $task_id");
	
		$notify_user = SQL_Single("SELECT notification_my_task_commented FROM users WHERE user_id = $task_user_id");

		if($notify_user){
			$users_to_notify[] = $task_user_id;
		}
		
		if($task_commenters){
			foreach($task_commenters as $user_id){
				
				$notify_user_on_comment = SQL_Single("SELECT notification_task_commented FROM users WHERE user_id = $user_id");

				if($notify_user_on_comment){
					$users_to_notify[] = $user_id;
				}
				
			}
		}
	
	}

	if($users_to_notify){

		//remove duplicates
		$users_to_notify = array_unique($users_to_notify);
		
		//remove the user performing the action
		if(($key = array_search($user->user_id, $users_to_notify)) !== false) {
			unset($users_to_notify[$key]);
		}

		if($users_to_notify){
			foreach($users_to_notify as $user_id){
			
				$notify_by_email = get_user_detail($user_id, 'notification_by_email');
				$notify_by_cell = get_user_detail($user_id, 'notification_by_cell');
				
				if($notify_by_email){
					notification_email($user_id, $task_id);
				}
				
				if($notify_by_cell){
					notification_cell($user_id, $task_id);
				}
			
			}
		}
		
	}
	
	function notification_email($user_id, $task_id){
		
		global $webmaster; //webmaster email address
		
		$email = SQL_Single("SELECT email FROM users WHERE user_id = $user_id");
		
		$task_title = SQL_Single("SELECT title FROM tasks WHERE task_id = $task_id");
		
		$latest_comment = SQL_Single("SELECT comment FROM comments WHERE comment_id IN (SELECT MAX(comment_id) FROM comments WHERE task_id = $task_id) ");

		$subject = "Gemiini Task $task_id";
		
		$html_message = "
								<html>
									<head>
										<title>$subject</title>
									</head>
									<body>

										<b>$task_title</b>
										
										<br><br>
										
										\"$latest_comment\"
										
										<br><br>
										
										<a href='http://tasks.gemiini.org/task/$task_id/'>http://tasks.gemiini.org/task/$task_id/</a>
										
										<br><br>
										
										END OF MESSAGE
										
									</body>
								</html>
								";

		$headers  = "MIME-Version: 1.0 \r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		$headers .= "To: $email \r\n";
		$headers .= "From: $webmaster <$webmaster> \r\n";

		if($_SERVER['SERVER_ADDR'] != "127.0.0.1"){
			
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			
				mail($email, $subject, $html_message, $headers);
				
			}
			
		}
		
	}
	
	function notification_cell($user_id, $task_id){
		
		global $webmaster; //webmaster email address
		
		$cell = SQL_Single("SELECT cell FROM users WHERE user_id = $user_id");
		$cell_carrier_id = SQL_Single("SELECT cell_carrier_id FROM users WHERE user_id = $user_id");
		$cell_email = SQL_Single("SELECT email FROM cell_carriers WHERE cell_carrier_id = $cell_carrier_id");
		
		$email = $cell . $cell_email;
		
		//$task_title = SQL_Single("SELECT title FROM tasks WHERE task_id = $task_id");
		
		$latest_comment = SQL_Single("SELECT comment FROM comments WHERE comment_id IN (SELECT MAX(comment_id) FROM comments WHERE task_id = $task_id) ");

		$subject = "Gemiini Task $task_id";
		
		$message = "$latest_comment";

		$headers  = "MIME-Version: 1.0 \r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1 \r\n";
		$headers .= "To: $email \r\n";
		$headers .= "From: $webmaster <$webmaster> \r\n";

		if($_SERVER['SERVER_ADDR'] != "127.0.0.1"){
		
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			
				mail($email, $subject, $message, $headers);
				
			}
			
		}
		
	}

?>
