<?php

	include("../server/server.php");
	
	if(isset($_POST['cell'])){
		$cell = $_POST['cell'];
	} else {
		echo "Please enter a cell phone number.";
		exit;
	}
	
	if($cell == ""){
		echo "Please enter a cell phone number.";
		exit;
	}
	
	if(isset($_POST['cell_carrier'])){
		$cell_carrier = $_POST['cell_carrier'];
	} else {
		$cell_carrier = 0;
	}
	
	$cell = preg_replace('#[^0-9/]#', '', trim(strip_tags($cell)));
	
	if(substr($cell, 0, 1) == 1){
		$cell = substr($cell, -10);
	}

	$cell = mysqli_real_escape_string($db_selected, $cell);

	SQL_Generic("UPDATE users SET cell = '$cell', cell_carrier_id = $cell_carrier WHERE user_id = $user->user_id ");

	echo 1;
	exit;

?>
