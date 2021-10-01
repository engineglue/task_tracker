<?php

	include("./server/server.php");

?>

<!DOCTYPE html> 
<html>  
	<head>
		<meta name="viewport" content="width=320">
		<title>Task Tracker</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
		<script src="../../js/scripts.js"></script>
		<link href="../../css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	
		<div id="header" style="padding:9px 10px 0px 10px;">
	
			<div style="float:left;">
				<img width=14 src="../../images/icon.png"> Task Tracker
			</div>
		
			<div id="menu" style="float:right;">
				<a class="button" href="../../tasks/">View tasks</a> 
				<a class="button" href="../../task/">Create task</a> 
				<a class="button" href="../../settings/">Settings</a> 
				<a class="button" href="../../reports/">Reports</a> 
				<a class="button" href="../../logout/">Log out</a>
			</div>	

		</div>
		
		<hr>
		
		<div class="clear"></div>
