<?php

	function get_user_id($username){

		return SQL_Single("SELECT user_id FROM users WHERE username LIKE '$username' ");
	
	}

	function user_exists($username){

		return SQL_Single("SELECT COUNT(*) FROM users WHERE username LIKE '$username' ");
	
	}
	
	function get_user_detail($user_id, $detail){
	
		return SQL_Single("SELECT $detail FROM users WHERE user_id = $user_id ");
	
	}
	
	function get_user_roles($user_id){
	
		return SQL_Array("SELECT role_id FROM role_user_link WHERE user_id = $user_id ");
	
	}

	function create_unique_username($username, $count = ""){

		$newUsername = $username . $count;

		$user_exists = SQL_Single("SELECT COUNT(*) FROM users WHERE username LIKE '$newUsername' ");

		if($user_exists){
			$count++;
			$result = create_unique_username($username, $count);
		} else {
			$result = $newUsername;
		}
		
		if($count == 90){
			$result = $username . time();
		}
		
		return $result;

	}
	
	function create_password($length = 8){

		$password = "";

		$chars = "2346789BCDFGHKMNPRTVWXYZ";

		$i = 0; 
		while ($i < $length) { 
			$char = substr($chars, rand(0, strlen($chars)-1), 1);
			$password .= $char;
			$i++;
		}

		return $password;

	}

?>
