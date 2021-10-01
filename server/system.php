<?php

	// use SQL_Single to retrieve a single record from the database
	// example: echo SQL_Single("SELECT email_address FROM users WHERE username LIKE 'Howard'");
	function SQL_Single($query){
		
		global $db_host; 		
		global $db_username; 		
		global $db_password; 		
		global $db_name; 	
		
		$db = new mysqli($db_host, $db_username, $db_password, $db_name);
		
		//$result = mysql_query($query);
		$result = $db->query($query);
		
		if (!$result) {
			exit;
		}
		
		//$row = mysql_fetch_row($result);
		$row = $result->fetch_row();
		

		if(isset($row)){

			return $row[0];

		} else {
			return false;
		}
		
		$result->close();
		$db->close();

	}

	// use SQL_Array to retrieve an array of values
	// example: $my_array = SQL_Array("SELECT email_address FROM users");
	function SQL_Array($query){
		
		global $db_host; 		
		global $db_username; 		
		global $db_password; 		
		global $db_name; 	
		
		$db = new mysqli($db_host, $db_username, $db_password, $db_name);

		//$result = mysql_query($query);
		$result = $db->query($query);
		
		if (!$result) {
			exit;
		}

		//while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		//	$results[] = $row[0];
		//}
		while($row = $result->fetch_array()){
			$results[] = $row[0];
		}
		//$results[] = $result->fetch_array();
		
		if(isset($results)){
			return $results;	
		} else {
			return false;
		}
		
		//mysql_free_result($result);
		$result->close();
		$db->close();
		
	}
	
	
	// use SQL_Assoc to retrieve an associative array of values
	// example: $my_array = SQL_Assoc("SELECT * FROM users");
	function SQL_Assoc($query){
		
		global $db_host; 		
		global $db_username; 		
		global $db_password; 		
		global $db_name; 	
		
		$db = new mysqli($db_host, $db_username, $db_password, $db_name);

		//$result = mysql_query($query);
		$result = $db->query($query);

		if (!$result) {
			return false;
		}

		if ($result->num_rows == 0) {
			return false;
		}
		
		//while(($resultArray[] = mysql_fetch_assoc($result)) || array_pop($resultArray));
		while($row = $result->fetch_assoc()){
			$fetched[] = $row;
		}
		//$fetched = $result->fetch_assoc();
		
		return $fetched;

		//mysql_free_result($result);
		$result->close();
		$db->close();
		
	}
	
	// use SQL_Generic to update or insert a record in/into the database
	// example: echo SQL_Generic("UPDATE users SET firstName = 'John' WHERE username LIKE 'Howard'");
	// example: echo SQL_Generic("INSERT INTO users (firstName) VALUES ('Howard')");
	function SQL_Generic($query){
		
		global $db_host; 		
		global $db_username; 		
		global $db_password; 		
		global $db_name; 	
		
		$db = new mysqli($db_host, $db_username, $db_password, $db_name);
		
		//$result = mysql_query($query);
		$result = $db->query($query);
		
		if (!$result) {
			exit;
		}

		//return mysql_insert_id();
		return $db->insert_id;

		$result->close();
		$db->close();

	}
	
?>
