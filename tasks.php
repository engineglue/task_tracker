<?php

	include("header.php");

?>

		<div style="margin:15px 15px 10px 15px;">	
		
			<input id="search" class="textbox" onkeyup="save_options();" value="Search.." onfocus="if(this.value=='Search..')this.value='';" onblur="if(this.value=='')this.value='Search..';">

			<select id="search_where" class="textbox" onchange="save_options();"></select>

			<select id="project" class="textbox" onchange="save_options();"></select>
			
			<select id="priority" class="textbox" onchange="save_options();"></select>
			
			<select id="status" class="textbox" onchange="save_options();"></select>
			
			<!--<select id="dont_show" class="textbox" onchange="save_options();"></select>-->
			
			<!--<select id="created_by" class="textbox" onchange="save_options();"></select>-->
			
			<select id="assigned_to" class="textbox" onchange="save_options();"></select>
			
			<select id="order_by" class="textbox" onchange="save_options();"></select>

			<span class="button" onclick="reset_options();">Reset</span>
			
			<div id="loading" style="float:right;margin:5px 9px 0px 9px;"></div>
			
			<div class="clear"></div>
		
		</div>

		<hr>

		<div id="tasks" style="margin-left:15px;min-height:700px;"></div>
		
		<br><br>

		<script>
			
			document.addEventListener('DOMContentLoaded', function() {
				onload_events();
			});

			function onload_events(){

				get_search_options('search_where');
				get_search_options('project');
				get_search_options('priority');
				get_search_options('status');
				get_search_options('created_by');
				get_search_options('assigned_to');
				get_search_options('order_by');
				get_search_options('dont_show');

				get_tasks();
			
			}
			
			function save_options(){

				$('#loading').html("<img src='../../images/loading.gif'>");
			
				var search_where = $("#search_where").val();
				var project = $("#project").val();
				var priority = $("#priority").val();
				var status = $("#status").val();
				var created_by = $("#created_by").val();
				var assigned_to = $("#assigned_to").val();
				var order_by = $("#order_by").val();
				var dont_show = $("#dont_show").val();
				
				if(search_where == null){
					search_where = '';
				}
				
				if(project == null){
					project = '';
				}
				
				if(priority == null){
					priority = '';
				}
				
				if(status == null){
					status = '';
				}
				
				if(created_by == null){
					created_by = '';
				}
				
				if(assigned_to == null){
					assigned_to = '';
				}
				
				if(order_by == null){
					order_by = '';
				}
				
				if(dont_show == null){
					dont_show = '';
				}

				$.post("../input/options_save.php", {search_where:search_where,
																		project:project,
																		priority:priority,
																		status:status,
																		created_by:created_by,
																		assigned_to:assigned_to,
																		order_by:order_by,
																		dont_show:dont_show}, function(data) {

					get_tasks();

				});

			}
			
			function reset_options(){

				$('#loading').html("<img src='../../images/loading.gif'>");
			
				var search_where = "";
				var project = "";
				var priority = "";
				var status = "";
				var created_by = "";
				var assigned_to = "";
				var order_by = "";
				var dont_show = "";
				
				$("#search").val("");
				$("#search_where").val($("#search_where option:first").val());
				$("#project").val($("#project option:first").val());
				$("#priority").val($("#priority option:first").val());
				$("#status").val($("#status option:first").val());
				$("#created_by").val($("#created_by option:first").val());
				$("#assigned_to").val($("#assigned_to option:first").val());
				$("#order_by").val($("#order_by option:first").val());
				$("#dont_show").val($("#dont_show option:first").val());

				$.post("../input/options_save.php", {search_where:search_where,
																		project:project,
																		priority:priority,
																		status:status,
																		created_by:created_by,
																		assigned_to:assigned_to,
																		order_by:order_by,
																		dont_show:dont_show}, function(data) {

					$('#loading').html("");
					
					get_tasks();
					
				});

			}
		
			function get_tasks(){

				$('#loading').html("<img src='../../images/loading.gif'>");
			
				var search = $("#search").val();
				
				if(search == 'Search..'){
					search = '';
				}

				if(search == null){
					search = '';
				}

				$.post("../output/tasks.php", {search:search}, function(data) {

					if(data){

						$('#tasks').html(data);
						
					}
					
					$('#loading').html("");
					
				});

			}
		
		</script>
	
<?php include("footer.php"); ?>
