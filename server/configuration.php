<?php

	date_default_timezone_set('America/Los_Angeles');

	//webmaster
	$webmaster = "wm@gmail.com";
	
	// dev server
	$db_host = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "tasks";

	// production server
	if($_SERVER['SERVER_ADDR'] != "127.0.0.1"){
		$db_host = 'localhost';
		$db_username = 'root';
		$db_password = '';
		$db_name = 'tasks';
	}
	
	//old connection string (prior to PHP 7.3 update)
	//databaseconnection
	//$link = mysql_connect($db_host, $db_username, $db_password);
	//$db_selected = mysql_select_db($db_dbname, $link);
	
	$db_selected = new mysqli($db_host, $db_username, $db_password, $db_name);
	
?>
