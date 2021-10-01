<?php

	include_once("../server/server.php");

	$notification = get_post('notification', 0);

	$status = SQL_Single("SELECT notification_$notification FROM users WHERE user_id = $user->user_id");
	
	if($status == 1){
		echo "true";
	} else {
		echo "false";
	}

?>
