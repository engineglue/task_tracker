<?php

	include("../server/server.php");
	
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	} else {
		echo "Please enter an email address.";
		exit;
	}
	
	if($email == ""){
		echo "Please enter an email address.";
		exit;
	}

	$email = mysqli_real_escape_string($db_selected, $email);

	SQL_Generic("UPDATE users SET email = '$email' WHERE user_id = $user->user_id ");

	echo 1;
	exit;

?>
