<?php/*
//Generate some random data:
include 'config.php';
//Use the chart class to build the chart:
// generate some random data
srand((double)microtime()*1000000);
$max = 50;
$data = array();
$title = array();
$begdate = array();
$count = 0;
if(!$_GET['year']){
	$defaultYear = date('Y');
}else{
	$defaultYear = $_GET['year'];
}
$con = mysql_connect(HOST,USERNAME,PASS);
if(!$con){ die('Could not connect: '.mysql_error()); }
mysql_select_db(DB,$con);

$exquery = mysql_query("SELECT `title`,`begdate` FROM `lists` WHERE `begdate` LIKE '%".$defaultYear."%'");
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

$title = new title( 'Disease Chart of '.$defaultYear );
$x = new x_axis();
$x->set_labels_from_array(array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec')); 

$y = new y_axis();
// grid steps:
$y->set_range( 0, 30, 5);
$bar = new bar_glass();
$bar->set_values($date_counter);
$bar->set_colour('#01DF74');
$y_legend = new y_legend('Number of Recorded Diseases in year '.$defaultYear);
$y_legend->set_style( '{font-size: 15px; color: #778877}' );


$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $bar );
$chart->set_x_axis( $x );
$chart->set_y_axis($y);
$chart->set_y_legend( $y_legend );

echo $chart->toPrettyString();
*/
?>