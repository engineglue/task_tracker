<?php

	function createUniqueDirectory($root, $directory, $count = 1){
	
		if($count == 1){
			$new_directory = $directory;
		} else {
			$new_directory = $directory . " " . $count;
		}

		if(file_exists($root . $new_directory . "/")){
			$directory_exist = 1;
		} else {
			$directory_exist = 0;
		}

		if($directory_exist){
			$count++;
			$result = createUniqueDirectory($root, $directory, $count);
		} else {
			if($count == 1){
				$result = $directory;
			} else {
				$result = $new_directory;
			}
		}
		
		if($count == 90){
			$result = $directory . " " . time();
		}
		
		return $result;

	}

?>