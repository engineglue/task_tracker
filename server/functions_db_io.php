<?php

	function stripUsername($username){
		$username = strtolower($username);
		$username = strip_tags($username);

		return preg_replace("/[^A-Za-z0-9-]/", "", $username); 

	}
	
	function stripFilename($file){
		$file = strtolower($file);
		$file = strip_tags($file);
		return preg_replace("/[^A-Za-z0-9-]/", "", $file); 
	}
	
	function stripInput($string){
		
		global $db_selected;
		
		$string = strip_tags($string);
		$string = mysqli_real_escape_string($db_selected, $string);
		return $string;
	}
	
	function stripQuestion($string){
		
		global $db_selected;
		
		$string = strip_tags($string, "<b><i><u><s><strike><a><img><li><ol><ul><p><strong><br><span><h1><h2><h3>");
		$string = mysqli_real_escape_string($db_selected, $string);
		return $string;
	}
	
	function stripAndKeepHTML($string){
		
		global $db_selected;
		
		$string = strip_tags($string, "<b><i><u><s><strike><a><img><li><ol><ul><p><strong><br><span><h1><h2><h3>");
		$string = mysqli_real_escape_string($db_selected, $string);
		return $string;
	}

	function stripMin($string){
		
		global $db_selected;
		
		$string = mysqli_real_escape_string($db_selected, $string);
		return $string;
	}
	
	function stripClean($string){
		$string = trim($string);
		$string = stripslashes($string);
		$string = str_replace("'", "", $string);
		$string = str_replace('"', "", $string);
		$string = str_replace("|", "", $string);
		$string = str_replace(":", "", $string);
		$string = str_replace("*", "", $string);
		$string = str_replace("?", "", $string);
		$string = str_replace("<", "", $string);
		$string = str_replace(">", "", $string);
		return $string;
	}
	
?>
