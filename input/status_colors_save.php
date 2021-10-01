<?php

	include("../server/server.php");
	
	if(isset($_POST['status_colors'])){
		$status_colors = $_POST['status_colors'];
	} else {
		exit;
	}
	
	$status = SQL_Array("SELECT status_id FROM status ORDER BY order_by");

	if($status){
	
		foreach($status as $status_id){
		
			$color = $status_colors[$status_id];
			
			if(strtoupper($color) == "FFFFFF"){
				$color = "000000";
			}
			
			$status_color_exists = SQL_Single("SELECT status_id FROM status_colors WHERE status_id = $status_id AND user_id = $user->user_id");
			
			if($status_color_exists){
			
				SQL_Generic("UPDATE status_colors SET color = '$color' WHERE status_id = $status_id AND user_id = $user->user_id");
				
			} else {
			
				SQL_Generic("INSERT INTO status_colors (status_id, user_id, color) VALUES ($status_id, $user->user_id, '$color')");
				
			}
			
		}
		
	}

	echo "Status colors saved.";
	
	exit;

?>