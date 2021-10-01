<!DOCTYPE html> 
<html>
	<head>
		<title>Task Tracker</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
		<script src="./js/scripts.js"></script>
		<link href="./css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	
		<center>
			
			<div style="margin:10px 0px 0px 0px;">
				<img width=14 src="../../images/icon.png"> Task Tracker
			</div>
			
			<hr>
			
			<br>
		
			<div class="login" style="margin:15px;">
				<div style="float:left;">
					Username - testuser
				</div>
				<input id="loginUsername" class="textbox" type="text"><br>
				<div style="float:left;">
					Password - password
				</div>
				<input id="loginPassword" class="textbox" type="password" onkeyup="if(event.keyCode == 13){login();}"><br>
				<div id="loginResult" class="result"></div>
				<div class="button" style="float:right;" onclick="login();">
					Login
				</div>
			</div>
			
			<br>
			
		</center>
	
<?php include("footer.php"); ?>
