<?php

	include("../server/server.php");
	
	$notification = get_post('notification', 0);
	$status = get_post('status', '');
	
	if($status == 'true'){
		$status = 1;
	} else {
		$status = 0;
	}
	
	SQL_Generic("UPDATE users SET notification_$notification = $status WHERE user_id = $user->user_id ");
	
	echo 1;
	exit;

?>