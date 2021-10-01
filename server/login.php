<?php

	session_start();

	include("configuration.php");

	include("functions_system.php");
	
	include("functions_db_io.php");
	
	include("functions_dir_io.php");
	
	include("functions_user.php");
	
	include("functions_mail.php");
	
	include("user.class.php");

	//get username
	$username = stripUsername($_POST['username']);

	//get password
	$password = stripInput($_POST['password']);

	//get challenge
	$challenge = stripInput($_POST['challenge']);

	if(user_exists($username)){
		$user_id =  get_user_id($username);
	} else {
		echo "Incorrect username or password.";
		exit;
	}

	$storedPassword = get_user_detail($user_id, 'password');

	$storedPassword = hash('sha256', $challenge . $storedPassword, false);
	
	if($storedPassword == $password){

		//set the session variable user id, useful for account pages
		$_SESSION['user_id'] = $user_id;
		
		echo 1;
	
	} else {
	
		echo "Incorrect username or password.";
	
	}

?>
