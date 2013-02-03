<html>
	<head>
	<?php
			include 'config.php';
			if(!isset($_GET['year'])){
				$current = date('Y');
			}else{
				$current = $_GET['year'];
			}	
			srand((double)microtime()*1000000);
			$title = array();
			$begdate = array();
			$count = 0;
			
			$con = mysql_connect(HOST,USERNAME,PASS);
			if(!$con){
				die('Could not connect: '.mysql_error());
			}
			mysql_select_db(DB,$con);
			
			$exquery = mysql_query("SELECT `title`,`begdate` FROM `lists` WHERE `begdate` LIKE '%".$current."%'");
			while($row = mysql_fetch_array($exquery)){
				$title[$count] = $row['title'];
				$begdate[$count] = $row['begdate'];
				$count++;
			}
			mysql_close($con);
			
			$date_counter = array(0,0,0,0,0,0,0,0,0,0,0,0);
			
			for($count2 = 0; $count2 <= $count;$count2++){
				$pieces = explode('-',$begdate[$count2]);
				if($pieces[1] == '01'){
					$date_counter[0]++;
				}
				else if($pieces[1] == '02'){
					$date_counter[1]++;
				}
				else if($pieces[1] == '03'){
					$date_counter[2]++;
				}
				else if($pieces[1] == '04'){
					$date_counter[3]++;
				}
				else if($pieces[1] == '05'){
					$date_counter[4]++;
				}
				else if($pieces[1] == '06'){
					$date_counter[5]++;
				}
				else if($pieces[1] == '07'){
					$date_counter[6]++;
				}
				else if($pieces[1] == '08'){
					$date_counter[7]++;
				}
				else if($pieces[1] == '09'){
					$date_counter[8]++;
				}
				else if($pieces[1] == '10'){
					$date_counter[9]++;
				}
				else if($pieces[1] == '11'){
					$date_counter[10]++;
				}
				else if($pieces[1] == '12'){
					$date_counter[11]++;
				}
				//$date_counter[0] = 20;
			}
			
				
			include_once('../../library/openflashchart/php-ofc-library/open-flash-chart.php');
			
			$title = new title( 'Disease Chart of '.$current );
			$x = new x_axis();
			$x->set_labels_from_array(array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));
			
			$y = new y_axis();
			// grid steps:
			$y->set_range( 0, 50, 5);
			$bar = new bar_glass();
			$bar->set_values($date_counter);
			$bar->set_colour('#01DF74');
			$y_legend = new y_legend('Number of Recorded Diseases in year '.$current);
			$y_legend->set_style( '{font-size: 15px; color: #778877}' );
			
			
			$chart = new open_flash_chart();
			$chart->set_title( $title );
			$chart->add_element( $bar );
			$chart->set_x_axis( $x );
			$chart->set_y_axis($y);
			$chart->set_y_legend( $y_legend );
			
			
		?>
	<script type="text/javascript" src="../../library/openflashchart/js/swfobject.js"></script>
	<script type="text/javascript">
		swfobject.embedSWF("../../library/openflashchart/open-flash-chart.swf", "chart", "500", "400", "9.0.0","expressInstall.swf",
				  {"get-data":"get_data_1"});
		swfobject.embedSWF("../../library/openflashchart/open-flash-chart.swf","chart2", "500", "400", "9.0.0","expressInstall.swf",
				  {"get-data":"get_data_2"});
	</script>
		
	</head>
	<body>
		<center>
		 
			<div id="navigation">
				<?php if($current == date('Y')){?>
				<a title="<?php echo $previous;?>" href="../charts/yearlyChart.php?year=<?php echo --$current;?>">Previous Year</a>
				<?php }else{?>
				<a title="<?php echo $previous;?>" href="../charts/yearlyChart.php?year=<?php echo --$current;?>">Previous Year</a> ----
				<a title="<?php echo $previous;?>" href="../charts/yearlyChart.php?year=<?php echo 2+$current;?>">Next Year</a>
				<?php }?>
			</div>
			<?php 
			include 'config.php';			
			$month = array();
			
			$month[0] = "01";
			$month[1] = "02";
			$month[2] = "03";
			$month[3] = "04";
			$month[4] = "05";
			$month[5] = "06";
			$month[6] = "07";
			$month[7] = "08";
			$month[8] = "09";
			$month[9] = "10";
			$month[10] = "11";
			$month[11] = "12";
			
			echo '<table border="5"><tr>';
			echo '<th>January</th><th>February</th><th>March</th><th>April</th><th>May</th><th>June</th><th>July</th><th>August</th><th>September</th><th>October</th><th>November</th><th>December</th></tr>';
			for($month_counter = 0; $month_counter<12;$month_counter++){
				echo '<td width="90">';
				$title = array();
				$begdate = array();
				$count = 0;
				
				$con = mysql_connect(HOST,USERNAME,PASS);
				if(!$con){ die('Could not connect: '.mysql_error()); }
				mysql_select_db(DB,$con);
				
				$exquery = mysql_query("SELECT DISTINCT `title` FROM `lists` WHERE `begdate` LIKE '%".date('Y')."-".$month[$month_counter]."-%'");
				while($row = mysql_fetch_array($exquery)){
					$title[$count] = $row['title'];
					$count++;
				}
				$counter = array();
				for($count2 = 0; $count2 < $count; $count2++){
					$count22 = 0;
					$exquery = mysql_query("SELECT `title` FROM `lists` WHERE title='".$title[$count2]."' AND `begdate` LIKE '%-".$month[$month_counter]."-%'");
					while($row = mysql_fetch_array($exquery)){
						$count22++;
					}
					$counter[$count2] = $count22;
					echo ''.$title[$count2].'='.$counter[$count2].'<br />';
				}
				
			}
			
			echo "</td></table>";
			mysql_close($con);
			
			$titled = new title( 'Total Disease'.$_GET['year'] );
			$xa = new x_axis();
			$xa->set_labels_from_array($title);
				
			$ya = new y_axis();
			// grid steps:
			$ya->set_range( 0, 50, 5);
			$bar2 = new bar_glass();
			$bar2->set_values($counter);
			$bar2->set_colour('#01DF74');
			$ya_legend = new y_legend('Total Number per Disease in year '.$_GET['year']);
			$ya_legend->set_style( '{font-size: 15px; color: #778877}' );
				
				
			$chart2 = new open_flash_chart();
			$chart2->set_title( $titled );
			$chart2->add_element( $bar2 );
			$chart2->set_x_axis( $xa );
			$chart2->set_y_axis($ya);
			$chart2->set_y_legend( $ya_legend );
			
			?>
			<script type="text/javascript">
			
				function get_data_1()
				{
				    return JSON.stringify(data);
				}
		
		
				function get_data_2(){
					return JSON.stringify(data2);
				}
		
				function findSWF(movieName) {
				  if (navigator.appName.indexOf("Microsoft")!= -1) {
				    return window[movieName];
				  } else {
				    return document[movieName];
				  }
				}
				    
				var data = <?php echo $chart->toPrettyString(); ?>;
		
				var data2 = <?php echo $chart2->toPrettyString();?>;
				
			</script>	
			<div id="chart"></div><div id="chart2"></div>
			
			
			
		</center>
		
	</body>
</html>