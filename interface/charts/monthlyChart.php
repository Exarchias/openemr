<html>
	<head>
	<?php 
		if(!isset($_GET['year'])){
			$current = date('Y');
		}else{
			$current = $_GET['year'];
			$static = $_GET['year'];
		}
		
		
		include 'config.php';
		$con = mysql_connect(HOST,USERNAME,PASS);
		if(!$con){
			die('Could not Connect: '.mysql_error());
		}
		mysql_select_db(DB,$con);
		
		$exquery = mysql_query("SELECT `title`,`begdate` FROM `lists` WHERE `begdate` LIKE '%".$current."-".$_REQUEST['month']."%'");
		while($row = mysql_fetch_array($exquery)){
			$title[$count] = $row['title'];
			$begdate[$count] = $row['title'];
			$count++;
		}
		mysql_close($con);
		$date_counter = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		
		for($count2 = 0;$count2<=$count;$count2++){
			$part = explode('-',$begdate[$count2]);
			if($part[2] == '01'){
				$date_counter[0]++;
			}else if($part[2] == '02'){
				$date_counter[1]++;
			}else if($part[2] == '03'){
				$date_counter[2]++;
			}else if($part[2] == '04'){
				$date_counter[3]++;
			}else if($part[2] == '05'){
				$date_counter[4]++;
			}else if($part[2] == '06'){
				$date_counter[5]++;
			}else if($part[2] == '07'){
				$date_counter[6]++;
			}else if($part[2] == '08'){
				$date_counter[7]++;
			}else if($part[2] == '09'){
				$date_counter[8]++;
			}else if($part[2] == '10'){
				$date_counter[9]++;
			}else if($part[2] == '11'){
				$date_counter[10]++;
			}else if($part[2] == '12'){
				$date_counter[11]++;
			}else if($part[2] == '13'){
				$date_counter[12]++;
			}else if($part[2] == '14'){
				$date_counter[13]++;
			}else if($part[2] == '15'){
				$date_counter[14]++;
			}else if($part[2] == '16'){
				$date_counter[15]++;
			}else if($part[2] == '17'){
				$date_counter[16]++;
			}else if($part[2] == '18'){
				$date_counter[17]++;
			}else if($part[2] == '19'){
				$date_counter[18]++;
			}else if($part[2] == '20'){
				$date_counter[19]++;
			}else if($part[2] == '21'){
				$date_counter[20]++;
			}else if($part[2] == '22'){
				$date_counter[21]++;
			}else if($part[2] == '23'){
				$date_counter[22]++;
			}else if($part[2] == '24'){
				$date_counter[23]++;
			}else if($part[2] == '25'){
				$date_counter[24]++;
			}else if($part[2] == '26'){
				$date_counter[25]++;
			}else if($part[2] == '27'){
				$date_counter[26]++;
			}else if($part[2] == '28'){
				$date_counter[27]++;
			}else if($part[2] == '29'){
				$date_counter[28]++;
			}else if($part[2] == '30'){
				$date_counter[29]++;
			}else if($part[2] == '31'){
				$date_counter[30]++;
			}
		
		}
		include '../../library/openflashchart/php-ofc-library/open-flash-chart.php';
		
		srand((double)microtime()*1000000);
		
		$title = new title( 'Disease Chart in the month of '.$_REQUEST['month'].','.$current );
		$y = new y_axis();
		$y->set_range(0,50,5);
		
		$bar = new bar_glass();
		$bar->set_values( $date_counter);
		$bar->set_colour('#01DF74');
		
		$y_legend = new y_legend('Total Number of Disease in the month of '.$_REQUEST['month']);
		$y_legend->set_style( '{font-size: 15px; color: #778877}' );
		
		$chart = new open_flash_chart();
		$chart->set_y_axis($y);
		$chart->set_y_legend($y_legend);
		$chart->set_title( $title );
		$chart->add_element( $bar );
		 
		
	?>
	
	<script type="text/javascript" src="../../library/openflashchart/js/swfobject.js"></script>
	<script type="text/javascript">
		swfobject.embedSWF("../../library/openflashchart/open-flash-chart.swf", "chart", "800", "400", "9.0.0","expressInstall.swf",
			  {"get-data":"get_data_1"});
	
		function menu_goto( menuform )
		{
		    // see http://www.thesitewizard.com/archive/navigation.shtml
		    // for an explanation of this script and how to use it on your
		    // own site
		
		    var baseurl = "http://<?php echo $_SERVER['SERVER_NAME'];?>/openemr/interface/charts/" ;
		    selecteditem = menuform.newurl.selectedIndex ;
		    newurl = menuform.newurl.options[ selecteditem ].value ;
		    if (newurl.length != 0) {
		      location.href = baseurl + newurl ;
		    }
		}

		function get_data_1()
		{
		    return JSON.stringify(data);
		}
		
		function findSWF(movieName) {
		  if (navigator.appName.indexOf("Microsoft")!= -1) {
		    return window[movieName];
		  } else {
		    return document[movieName];
		  }
		}
		    
		var data = <?php echo $chart->toPrettyString(); ?>;
		
	</script>
	</head>
	<body>
	<center>
		<div id="chart"></div>
		<?php 
		$month = array(01,02,03,04,05,06,07,08,09,10,11,12);
		if(!isset($_GET['month'])){
			$request = $_GET['month'];
		}else{
			$request = 01;
		}/*
		for($i=0;$i<12;$i++){
			echo $monthDet[$i];
		}*/
		if($_REQUEST['month'] == '02'){
			echo '
				<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" selected="selected">February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
				</select></form>
			';
		}
		else if($_REQUEST['month'] == '03'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" selected="selected">March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '04'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" selected="selected">April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '05'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" selected="selected">May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '06'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" selected="selected">June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '07'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" selected="selected">July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '08'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" selected="selected">August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '09'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" selected="selected">September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '10'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" selected="selected">October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '11'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" selected="selected">November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		else if($_REQUEST['month'] == '12'){
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'__self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" >January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" selected="selected">December</option>
			</select></form>
			';
		}
		else{
			echo '
			<form action="dummyvalue"><select onchange="window.open(this.options[this.selectedIndex].value,\'_self\')">
					<option value="monthlyChart.php?month=01&year='.$current.'" selected="selected">January</option>
					<option value="monthlyChart.php?month=02&year='.$current.'" >February</option>
					<option value="monthlyChart.php?month=03&year='.$current.'" >March</option>
					<option value="monthlyChart.php?month=04&year='.$current.'" >April</option>
					<option value="monthlyChart.php?month=05&year='.$current.'" >May</option>
					<option value="monthlyChart.php?month=06&year='.$current.'" >June</option>
					<option value="monthlyChart.php?month=07&year='.$current.'" >July</option>
					<option value="monthlyChart.php?month=08&year='.$current.'" >August</option>
					<option value="monthlyChart.php?month=09&year='.$current.'" >September</option>
					<option value="monthlyChart.php?month=10&year='.$current.'" >October</option>
					<option value="monthlyChart.php?month=11&year='.$current.'" >November</option>
					<option value="monthlyChart.php?month=12&year='.$current.'" >December</option>
			</select></form>
			';
		}
		?>
		<div id="navigation">
				<?php if($current == date('Y')){?>
				<a title="<?php echo $previous;?>" href="../charts/monthlyChart.php?month=<?php echo $_REQUEST['month'];?>&year=<?php echo --$current;?>">Previous Year</a>
				<?php }else{?>
				<a title="<?php echo $previous;?>" href="../charts/monthlyChart.php?month=<?php echo $_REQUEST['month'];?>&year=<?php echo --$current;?>">Previous Year</a> ----
				<a title="<?php echo $previous;?>" href="../charts/monthlyChart.php?month=<?php echo $_REQUEST['month'];?>&year=<?php echo 2+$current;?>">Next Year</a>
				<?php }?>
			</div>
		<?php
		$title = array();
		$begdate = array();
		$cnt = 0;
		
		include 'config.php';
		$con = mysql_connect(HOST,USERNAME,PASS);
		if(!$con){die('Could not connect: '.mysql_error());}
		
		mysql_select_db(DB,$con);
		$result = mysql_query("SELECT DISTINCT `title` FROM `lists` WHERE `begdate` LIKE '%".date('Y')."-".$_REQUEST['month']."-%'");
		while($row = mysql_fetch_array($result)){
			$title[$cnt] = $row['title'];
			$cnt++;
		}
		
		$counter = array();
		echo "<table border='1'><tr><th>Summary of Diseases</th></tr>";
			for($cnt9 = 0; $cnt9 < $cnt; $cnt9++){
				
				$cnt10 = 0;
				$result = mysql_query("SELECT `title` FROM `lists` WHERE `title`='".$title[$cnt9]."' AND `begdate` LIKE '%-".$_REQUEST['month']."-%'");
				while($row = mysql_fetch_array($result)){
					$cnt10++;
				}
				$counter[$cnt9] = $cnt10;
				echo "<tr><td >".$title[$cnt9]."=".$counter[$cnt9]."</td></tr>";
				
			}
		echo "</table>";
		mysql_close($con);
		?>
		</center>
	</body>
</html>