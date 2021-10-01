<?php

	include("header.php");
	
	$email = get_user_detail($user->user_id, 'email');
	
	$cell = get_user_detail($user->user_id, 'cell');
	
	$cell_carrier_id = get_user_detail($user->user_id, 'cell_carrier_id');
	
	if($email == ''){
		$email = "Change email address..";
	}
	
	if($cell == ''){
		$cell = "Change cell phone..";
	}

?>
		
		<script type="text/javascript" src="../../js/jscolor/jscolor.js"></script>
	
		<div style="margin:15px 15px 10px 15px;">	

			<input id="password" class="textbox" type="text" title="Change password" value="Change password.." onfocus="if(this.value=='Change password..')this.value='';" onblur="if(this.value=='')this.value='Change password..';">

			<input type="button" class="button" onclick="password_change();" value="Change password">
			
			<div id="loading" style="float:right;margin:5px 9px 0px 9px;color:red;"></div>
			
			<div class="clear"></div>
			
		</div>
		
		<hr>
		
		<div style="margin:15px 15px 10px 15px;">	

			<input id="email" class="textbox" type="text" title="Change email address." value="<?php echo $email; ?>" onfocus="if(this.value=='Change email address..')this.value='';" onblur="if(this.value=='')this.value='Change email address..';">

			<input type="button" class="button" onclick="email_change();" value="Change email">

		</div>
		
		<hr>
		
		<div style="margin:15px 15px 10px 15px;">	

			<input id="cell" class="textbox" type="text" title="Change cell phone." value="<?php echo $cell; ?>" onfocus="if(this.value=='Change cell phone..')this.value='';" onblur="if(this.value=='')this.value='Change cell phone..';">

			<select id="cell_carrier" class="textbox" title="Cell phone carriers.">
			
				<option value='0'>Choose cell carrier</option>
			
				<?php
				
					$cell_carriers = SQL_Assoc("SELECT cell_carrier_id, cell_carrier FROM cell_carriers ORDER BY cell_carrier");
					
					if($cell_carriers){
					
						$selected = "";
					
						foreach($cell_carriers as $carrier_array){
						
							$carrier_id = $carrier_array['cell_carrier_id'];
							$carrier = $carrier_array['cell_carrier'];
							
							if($cell_carrier_id == $carrier_id){
								$selected = "SELECTED";
							} else {
								$selected = "";
							}
						
							echo "<option value='$carrier_id' $selected>$carrier</option>";
						
						}
					
					}
				
				?>
				
			</select>
			
			<input type="button" class="button" onclick="cell_change();" value="Change cell phone">

		</div>
		
		<hr>
		
		<div style="margin:15px 15px 10px 15px;">	
		
			<form id='status_colors_form'>

				<?php
				
					$status = SQL_Assoc("SELECT status_id, status FROM status ORDER BY order_by");
					
					if($status){
					
						foreach($status as $status_array){
						
							$status_id = $status_array['status_id'];
							$status_name = $status_array['status'];
							
							$status_color = SQL_Single("SELECT color FROM status_colors WHERE status_id = $status_id AND user_id = $user->user_id");

							echo "<input name='status_color' class='color textbox' type='text' value='$status_name' title='$status_color' alt='$status_id'>";
						
						}
					
					}
				
				?>
				
				<input type="button" class="button" value="Save status colors" onclick="status_colors_save();">
				
			</form>

		</div>
		
		<hr>
		
		<div style="margin:15px 15px 10px 15px;">	
		
			<link rel="stylesheet" type="text/css" href="../../css/checkbox/style.css" media="screen" />
			
			<input type="checkbox" id="notification_task_created" onclick="notification_selection('task_created', this.checked);">
			<label for="notification_task_created"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me when a task is created.</div></label>
			
			<br>
		
			<input type="checkbox" id="notification_my_task_changed" onclick="notification_selection('my_task_changed', this.checked);">
			<label for="notification_my_task_changed"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me when my task has changed.</div></label>
			
			<br>
			
			<input type="checkbox" id="notification_my_task_commented" onclick="notification_selection('my_task_commented', this.checked);">
			<label for="notification_my_task_commented"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me when my task has new comments.</div></label>
			
			<br>
			
			<input type="checkbox" id="notification_task_changed" onclick="notification_selection('task_changed', this.checked);">
			<label for="notification_task_changed"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me when a task I've commented changes.</div></label>
			
			<br>
			
			<input type="checkbox" id="notification_task_commented" onclick="notification_selection('task_commented', this.checked);">
			<label for="notification_task_commented"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me when a task I've commented has new comments.</div></label>
			
			<br>
			
			<input type="checkbox" id="notification_by_email" onclick="notification_selection('by_email', this.checked);">
			<label for="notification_by_email"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me via email.</div></label>
			
			<br>
			
			<input type="checkbox" id="notification_by_cell" onclick="notification_selection('by_cell', this.checked);">
			<label for="notification_by_cell"><span></span><div class="input_label" style="width:auto;overflow:hidden;">Notify me via text message.</div></label>
			
			<br><br>

		</div>
		
		<hr>
		
		<script>
		
			$(document).ready(function() {

				notification_statuses();
				
			});
			
			function notification_selection(notification, status){
			
				$('#loading').html("<img src='../../images/loading.gif'>");

				$.post("../../input/notification_change.php", {notification:notification,status:status}, function(data) {
					
					if(data == 1){
						$("#loading").html("Selection Saved.");
					} else {
						$('#loading').html("There was an error.");
					}
					
				});
			
			}
			
			function notification_statuses(){

				notification_status('task_created');
				notification_status('my_task_changed');
				notification_status('my_task_commented');
				notification_status('task_changed');
				notification_status('task_commented');
				notification_status('by_email');
				notification_status('by_cell');
			
			}
			
			function notification_status(notification){

				$.post("../../output/notification_status.php", {notification:notification}, function(data) {

					if(data == 'true'){
						$("#notification_"+notification).attr("checked", "checked");
					}
					
				});
			
			}
		
			function status_colors_save(){
			
				$('#loading').html("<img src='../../images/loading.gif'>");
			
				var $inputs = $("#status_colors_form :input[name='status_color']");
				var status_id = 0;
				var status_colors = new Array();
				
				$inputs.each(function() {
				
					status_id = $(this).attr('alt');
					status_colors[status_id] = $(this).attr('title');
					
				});

				$.post('../../input/status_colors_save.php', {status_colors: status_colors}, function(data) {

					$('#loading').html(data);
					
				});
				
			}
		
			function password_change(){
	
				$('#loading').html("<img src='../../images/loading.gif'>");

				var password = $("#password").val();
				
				if(password == 'Change password..'){
					$("#loading").html("Please enter a new password.");
					exit;
				}

				if(password == ""){
					$("#loading").html("Please enter a new password.");
					exit;
				}

				password = SHA256(password);

				$.post('../../input/password_change.php', {password: password}, function(data) {

					$('#password').val('Change password..');
					$('#loading').html(data);
					
				});
			
			}
			
			function email_change(){
	
				$('#loading').html("<img src='../../images/loading.gif'>");

				var email = $("#email").val();
				
				if(email == 'Change email address..'){
					$("#loading").html("Please enter an email address.");
					exit;
				}

				if(email == ""){
					$("#loading").html("Please enter an email address.");
					exit;
				}
				
				if(!validateEmail(email)){
					$("#loading").html("Please enter a valid email address.");
					exit;
				}

				$.post('../../input/email_change.php', {email: email}, function(data) {

					if(data == 1){
						$('#loading').html('Email address changed.');
					} else {
						$('#loading').html(data);
					}
					
				});
			
			}
			
			function cell_change(){
	
				$('#loading').html("<img src='../../images/loading.gif'>");

				var cell = $("#cell").val();
				var cell_carrier = $("#cell_carrier").val();
				
				if(cell == 'Change cell phone..'){
					$("#loading").html("Please enter a cell phone number.");
					exit;
				}

				if(cell == ""){
					$("#loading").html("Please enter a cell phone number.");
					exit;
				}

				$.post('../../input/cell_change.php', {cell: cell, cell_carrier:cell_carrier}, function(data) {

					if(data == 1){
						$('#loading').html('Cell phone changed.');
					} else {
						$('#loading').html(data);
					}
					
				});
			
			}

		</script>
	
<?php include("footer.php"); ?>