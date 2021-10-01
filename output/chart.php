<?php

	include("../server/server.php");
	
	$chart_id = get_post('chart_id', '');
	
	switch($chart_id){
	
		case "1": //worker efficiency
		
			

			if($line1 == ""){
				$line1 = "[$week_count, $word_count]";
			} else {
				$line1 .= ", [$week_count, $word_count]";
			}
			
			
			if($end_date > $this_week){
				$weeks_left = round(($end_date - $this_week) / $one_week);
			} else {
				$weeks_left = 0;
			}
			
			$total_weeks = $week_count + $weeks_left;

			//projection
			if($this_week < $end_date){

				if($word_count > 0){
					$acquisition_rate = $word_count / $week_count;
				} else {
					$acquisition_rate = 0;
				}
				
				$projected_words = $total_weeks * $acquisition_rate;

				$line2 .= "[$week_count, $word_count]";
				$line2 .= ", [$total_weeks, $projected_words]";
				
			}
			
			//neurotypical
			$acquisition_rate = 20;
			$neurotypical_words = $total_weeks * $acquisition_rate;

			$line3 .= "[0, 0]";
			$line3 .= ", [$total_weeks, $neurotypical_words]";
			
			
			$left_label = "";
			$bottom_label = "";

			if($line1 OR $line2){
			
				echo "

						<div class='example-plot'></div>

						<style type='text/css'>
						
							.jqplot-point-label {white-space: nowrap;}

							div.jqplot-target {
								height: 400px;
								width: 750px;
								margin: 0px;
							}
							
						</style>

						<script class='code' type='text/javascript' language='javascript'>
							$(document).ready(function(){   
							
								$.jqplot.config.enablePlugins = true;

								var line1 = [$line1];
								var line2 = [$line2];

								var plot1 = $.jqplot('$id', [line1, line2], {
									axesDefaults: {
										min: 0
									},
									axes: {
										xaxis: {
											label: '$bottom_label',
											location:'top'
										},
										yaxis: {
											label: '$left_label'
										}
									},
									cursor:{
										zoom:true,
										dblClickReset:true,
										tooltipLocation:'nw'
									}
								});
							});
						</script>";
						
			} else {
			
				echo "No chart data.";
			
			}
			
			break;
			
	}
	
?>