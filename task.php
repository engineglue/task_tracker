<?php

	include("header.php");
	
	$switches = explode("/", $_SERVER["REQUEST_URI"]);
	
	if(count($switches) > 3){
		$task_id = $switches[2];
	} else {
		$task_id = 0;
	}

?>
		<div style="margin:15px 15px 10px 15px;">	
		
			<input id="title" class="textbox" style="width:50%;" title="Task short description" value="Task short description" onfocus="if(this.value=='Task short description')this.value='';" onblur="if(this.value=='')this.value='Task short description';">

			<select id="project" class="textbox" title="Project"></select>
			
			<select id="priority" class="textbox" title="Priority"></select>
			
			<select id="status" class="textbox" title="Status"></select>

			<select id="assigned_to" class="textbox" title="Assigned to"></select>
			
			<input id="estimate" class="textbox" style="width:110px;" title="Estimated time" alt="Estimated time" value="Estimated time" onkeyup="$(this).attr('title', this.value+' hours');$(this).attr('alt', this.value);" onfocus="if(this.value=='Estimated time'){this.value='';}else{this.value=$(this).attr('alt');};" onblur="if(this.value==''){this.value='Estimated time';}else{this.value=$(this).attr('title');};">

			<input id="actual" class="textbox" style="width:110px;" title="Actual time" alt="Actual time" value="Actual time" onkeyup="$(this).attr('title', this.value+' hours');$(this).attr('alt', this.value);" onfocus="if(this.value=='Actual time'){this.value='';}else{this.value=$(this).attr('alt');};" onblur="if(this.value==''){this.value='Actual time';}else{this.value=$(this).attr('title');};">

			<span class="button" onclick="save_task();">Save</span>
			
			<div id="loading" style="float:right;margin:5px 9px 0px 9px;color:red;"></div>
			
			<div class="clear"></div>
		
		</div>

		<hr>

		<div id="comment_section" style="display:none;min-height:700px;">
		
			<div style="position:relative;margin:15px;">
			
				<textarea id="comment" class="textbox" style="width:95%;height:100px;float:right;" title="New comment.." onfocus="if(this.value=='New comment..')this.value='';" onblur="if(this.value==''){this.value='New comment..';$(this).height('100px');$('#expand').show();}">New comment..</textarea>
				
				<span id="expand" style="position:absolute;right:5px;bottom:57px;font-size:12px;cursor:pointer;" onclick="$('#comment').height('300px');$(this).hide();">expand</span>
				
				<br>
				
				<span class="button" onclick="save_comment();" style="float:right;">Save comment</span>
				
				<span class="button" onclick="$('#upload_form_container').show();" style="float:right;margin-right:5px;">Attach file(s)</span>

				<div class="clear"></div>
			
			</div>
			
			<hr>
			
			<div id="comments" style="margin:15px;"></div>
		
		</div>
		
		<div id='upload_form_container' class='generic_popup_outer' style="display:none;">

			<div class='generic_popup_inner'>

				<div onclick="$('#upload_form_container').hide();" style='float:right;cursor:pointer;'>Cancel</div>

				<div style='font-size:24px;text-align:left;'>Attach file(s)</div><br><br>

				<div style='text-align:center;margin:15px;'>
				
					<form id='upload_form' action="../../input/files_attach.php" method="post" enctype="multipart/form-data">

						<input id="files" type="file" name="files[]" multiple="" >
						
						<input id="attach_task_id" type="hidden" name="task" value="" >

						<input class="button" type="button" value="Attach file(s)" onclick="upload_files();">

					</form>
				
				</div><br>

			</div>
		</div>
		
		<br><br>

		<script>
		
			var task_id = <?php echo $task_id; ?>;
		
			$(document).ready(function(){
			
				get_task_title(task_id);
				
				if(task_id){
					show_comments();
				}

				get_create_options('project', task_id);
				get_create_options('priority', task_id);
				get_create_options('status', task_id);
				get_create_options('assigned_to', task_id);

				get_estimated_time(task_id);

			});
			
			function upload_files(){
			
				$('#attach_task_id').val(task_id);
				
				$('#upload_form').submit();
			
			}
			
			function show_comments(){
			
				$('#loading').html("<img src='../../images/loading.gif'>");
			
				$('#comment_section').show();
				
				$.post("../../output/comments.php", {task:task_id
																		}, function(data) {
					
						$('#comments').html(data);

						$('#loading').html("");

				});
			
			}
			
			function save_task(override){
			
				$('#loading').html("<img src='../../images/loading.gif'>");

				var title = $("#title").val();
				var project = $("#project").val();
				var priority = $("#priority").val();
				var status = $("#status").val();
				var assigned_to = $("#assigned_to").val();
				var estimate = $("#estimate").attr('alt');
				var actual = $("#actual").attr('alt');
				
				estimate = estimate.replace(/[^\d.]/g, '');
				actual = actual.replace(/[^\d.]/g, '');

				$.post("../../input/task_save.php", {task:task_id,
																	title:title,
																	project:project,
																	priority:priority,
																	status:status,
																	assigned_to:assigned_to,
																	estimate:estimate,
																	actual:actual,
																	override:override
																	}, function(data) {

					if(isInteger(data)){
					
						$('#loading').html("");
					
						task_id = data;
						show_comments();
						
					} else {
					
						$('#loading').html(data);
						
					}
					
				});
			
			}
			
			function save_comment(){
			
				$('#loading').html("<img src='../../images/loading.gif'>");

				var comment = $("#comment").val();

				$.post("../../input/comment_save.php", {task:task_id,
																				comment:comment
																				}, function(data) {
					
					if(isInteger(data)){
					
						$('#loading').html("");
						
						$('#comment').val("New comment..");
						
						$('#comment').height("100px");
						
						$('#expand').show();

						show_comments();
						
					} else {
					
						$('#loading').html(data);
						
					}
					
				});
			
			}
			
			function get_task_title(task){

				$.post("../../output/task_title.php", {task:task}, function(data) {
					
					if(data == 0){
					
						$("#title").val("Task short description");

					} else {
					
						$("#title").val(data);
					
					}
					
				});
		
			}
			
			function get_estimated_time(task){

				$.post("../../output/time_estimated.php", {task:task}, function(data) {
					
					if(data == 0){
					
						$("#estimate").val("Estimated time");
						
					} else {
					
						$("#estimate").val(data + ' hours');
						$("#estimate").attr('title', data + ' hours');
						$("#estimate").attr('alt', data);
					
					}
					
				});
		
			}
			
			function get_actual_time(task){

				$.post("../../output/time_actual.php", {task:task}, function(data) {
					
					if(data == 0){
					
						$("#actual").val("Actual time");
						
					} else {
					
						$("#actual").val(data + ' hours');
						$("#actual").attr('title', data + ' hours');
						$("#actual").attr('alt', data);
					
					}
					
				});
		
			}

		</script>
	
<?php include("footer.php"); ?>
