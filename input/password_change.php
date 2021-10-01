<?php

	include("../server/server.php");
	
	if(isset($_POST['password'])){
		$password = $_POST['password'];
	} else {
		echo "Please enter a new password.";
		exit;
	}
	
	if($password == ""){
		echo "Please enter a new password.";
		exit;
	}

	SQL_Generic("UPDATE users SET password = '$password' WHERE user_id = $user->user_id ");

	echo "Password changed.";
	exit;

?>