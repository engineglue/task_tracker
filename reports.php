<?php

	include("header.php");
	
?>

		<div style="margin:15px 15px 10px 15px;">	
		
			<select id="username" class="textbox">
				<?php
				
					$users = SQL_Array("SELECT username FROM users ORDER BY username");
					
					if($users){
						foreach($users as $username){
						
							echo "<option value='$username'>$username</option>";
						
						}
					}
				
				?>
			</select>

			<select id="report_id" class="textbox" >
				<option value="1">Worker efficiency</option>
			</select>
			
			<input type="button" class="button" value="Get report" onclick="get_report();">

		</div>

		<hr>

		<div id="chart" style="margin-left:15px;min-height:700px;"></div>
		
		<br><br>

		<script>
		
			$(document).ready(function(){

			});
			
			function get_report(){
				
				var username = $('#username').val();

				window.location = "../../report/worker_efficiency.php?username="+username;

			}
		
		</script>
	
<?php include("footer.php"); ?>
