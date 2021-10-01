<?php

	//start the session, carries over session variables
	session_start();
	
	session_destroy(); 
	session_unset(); 

	header("Location: ../../");
	exit;
	
?>
