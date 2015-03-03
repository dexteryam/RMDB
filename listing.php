<?php
	include_once("include/header.php");
	
	///////////////////////////////////////////////
	//Functions
	///////////////////////////////////////////////
	
	//Displays the times in the table
	function display_times($time_hour,$time_min,$time_ampm,$num_timeblock){
	$timeblock_loop = 0;
		while($timeblock_loop<$num_timeblock){
			echo"<td>$time_hour:$time_min $time_ampm </td>";
		
			//Change between am and pm
			if($time_hour == 11 && $time_min == "30"){
				if($time_ampm == "am"){
					$time_ampm = "pm";
				}
				else if($time_ampm == "pm"){
					$time_ampm = "am";
				}
			}
		
			//Alternate between 00 and 30
			if($time_min == "00"){
				$time_min = "30";
			}
				
			//Increase hour when previous minutes were 30
			else if($time_min == "30"){
				$time_min = "00";
				if($time_hour == 12)
				{
					$time_hour = 1;
				}
				else{
					$time_hour += 1;
				}
			}
			$timeblock_loop++;
		}
		echo"</tr>";
	}
	
	//Displays the channel name and programs
	function display_channels($time_hour,$time_min,$time_ampm,$num_timeblock,&$date_day,&$date_month,&$date_year){
		$time_hour2 = $time_hour;

		$ch_iter = 1;
		$ch_loop = 0;
		$timeblock_loop = 0;
		$result = mysql_query("SELECT * FROM channels");
		$num_rows = mysql_num_rows($result);
	
		//Query for channel according to value ch_start
		while($ch_loop<$num_rows){
			$temp_ampm = $time_ampm;
			$query = "SELECT ch_name FROM channels WHERE ch_id = '$ch_iter'";
			$ch_name = Db::query_row($query);
			$timeblock_loop = 0;
			echo"<tr><td>".$ch_name['ch_name']."</td>";
			
			$temp_day = $date_day;
			$temp_month = $date_month;
			$temp_year = $date_year;

			while($timeblock_loop < $num_timeblock){
				$query = "SELECT show_id FROM listing  WHERE ch_id = '$ch_iter' 
						AND hour='$time_hour' AND min='$time_min' AND am_pm='$temp_ampm' AND day='$temp_day' AND month='$temp_month' AND year='$temp_year'";
				$show = Db::query_row($query);
				$show_id = $show['show_id'];
				$query = "SELECT name FROM shows WHERE id ='$show_id'";
				$title = Db::query_row($query);
				if($title){
					echo "<td>".$title['name']."</td>";
				}
				else{
					echo "<td>N/A </td>";
				}
				$timeblock_loop++;
				
				//Change between am and pm
				if($time_hour == 11 && $time_min == "30"){
					if($temp_ampm == "am"){
						$temp_ampm = "pm";
					}
					else if($temp_ampm == "pm"){
						$temp_ampm = "am";
						if($temp_month == 2 && $temp_day == 28 && ($temp_year%4!=0)){
							$temp_day = 00;
							$temp_month = $date_month+1;
						}
						if($temp_month == 2 && $temp_day == 29 && ($temp_year%4==0)){
							$temp_day = 00;
							$temp_month = $date_month+1;
						}	
						if($temp_month == 1 || $temp_month == 3 || $temp_month == 5 || $temp_month == 7|| 
						$temp_month == 8|| $temp_month == 10|| $temp_month == 12){
							if($temp_day == 31){
								$temp_day = 00;
								if($temp_month >= 12){
									$temp_month = 1;
									$temp_year = $date_year+1;
								}
								else if($temp_month < 12){
									$temp_month = $date_month+1;
								}
							}
						}
						if($temp_month == 4 || $temp_month == 6 || $temp_month == 9 || $temp_month == 11 ){
							if($temp_day == 30){
								$temp_day = 0;
								$temp_month = $date_month+1;
							}
						}
						
						$temp_day = $temp_day+1;
						
					}
				}
				
				if($time_min == "00"){
					$time_min = "30";
				}
				
				else if($time_min == "30"){
					$time_min = "00";
					if($time_hour == 12)
					{
					$time_hour = 1;
					}
					else{
						$time_hour += 1;
					}
				}
			}
			$time_hour = $time_hour2;
			$ch_loop++;
			$ch_iter++;
		}
		$date_day = $temp_day;
		$date_month = $temp_month;
		$date_year = $temp_year;
	}
	///////////////////////////////////////////////
	//Main
	///////////////////////////////////////////////
	date_default_timezone_set('America/Los_Angeles');
	if(isset($_GET['tz'])){
		$timezone = $_GET['tz'];
	}
	else{
		$timezone = "PST";
	}
	if(isset($_POST['submit'])){
		$timezone = $_POST['timezone'];
		if($timezone == "PST"){
			date_default_timezone_set('America/Los_Angeles');
		}
		if($timezone == "MST"){
			date_default_timezone_set('America/Denver');
		}
		if($timezone == "CST"){
			date_default_timezone_set('America/Managua');
		}
		if($timezone == "EST"){
			date_default_timezone_set('America/New_York');
		}
	
	
	}
	$date = new DateTime('2001-01-01');

	echo"<h1>TV Listing</h1>";
	
	//Current hour, minute, and am/pm
	$cur_ampm = date("a");
	$cur_hour = date("H");
	$cur_min = date("i");
	$cur_day = date("d");
	$cur_month = date("m");
	$cur_year = date("Y");
	
	
	//If _GET is set, show listings from that time instead
	if(isset($_GET["t"]) && isset($_GET["m"])){
		$time_hour = $_GET["t"];
		$time_ampm = $_GET["m"];
		$date_day = $_GET["d"];
		$date_month = $_GET["mo"];
		$date_year = $_GET["y"];
		if($time_hour == 0){
			$time_hour = 12;
		}
		$date->setDate($date_year,$date_month,$date_day);
		$date->setTime($time_hour, date("i"));
		
	}
	
	else{
		$date->setDate($cur_year,$cur_month,$cur_day);
		$date->setTime($cur_hour, $cur_min);
		$time_ampm = date("a");
		$time_hour = date("h");	
		$date_day = date("d");
		$date_month = date("m");
		$date_year = date("Y");
	}
	if($cur_min >= 30 && $cur_min <=59){
		$time_min = "30";
	}
	else if($cur_min <30){
		$time_min = "00";
	}	
	
	//Display the next 10 blocks of time
	$num_timeblock = 10;
	
	$temp_day = $date_day;
	$temp_month = $date_month;
	$temp_year = $date_year;

	//Start table
	echo "<table><tr id=\"full_width_title_bar\"> <td>Channel</td>";
	
	//Display time loop
	display_times($time_hour,$time_min,$time_ampm,$num_timeblock);
	
	//Channel display loop
	display_channels($time_hour,$time_min,$time_ampm,$num_timeblock,$date_day,$date_month,$date_year);
	$date->setDate($date_year,$date_month,$date_day);

	
	$next_ampm = $time_ampm;
	$prev_ampm = $time_ampm;
	$next_day = $temp_day;
	$prev_day = $temp_day;
	$next_month = $date_month;
	$next_year = $temp_year;
	$prev_month = $date_month;
	$prev_year = $temp_year;
	
	//next_hour represents the next 5 hours of listings
	if($time_hour == 12){
		$next_hour = 5;
		$prev_hour = -5;
	}
	else{
		$next_hour = $time_hour + 5;
		$prev_hour = $time_hour - 5;
	}
	
	//prev_hour represents the last 5 hours of listings
	//echo "next_hour :".$next_hour." || cur_hour: ".$time_hour." || prev_hour: ".$prev_hour;
	
	//Accounting for 12-hour clock
	if($next_hour >= 12){
		$next_day = $date_day;
		$next_hour -= 12;
		if($next_ampm == "am"){
			$next_ampm = "pm";
		}
		else if($next_ampm == "pm"){
			$next_ampm = "am";
		}
	}
	
	if($prev_hour < 0){
		if($time_ampm == "am"){
			$prev_day = $temp_day - 1;
		}
		$prev_hour += 12;
		if($prev_ampm == "am"){
			$prev_ampm = "pm";
		}
		else if($prev_ampm == "pm"){
			$prev_ampm = "am";
		}
	}
	
	//A link to go to the next 5 hours of tv listings
	echo '<div id="full_width_content_bar"><div id="bar">';
	echo '<div id="left">';
	echo "<a href = \"listing.php?t=$prev_hour&m=$prev_ampm&d=$prev_day&mo=$prev_month&y=$prev_year&tz=$timezone\"> Prev </a> ";
	echo '</div>';
	echo '<div id="center">';
	echo "<a href = \"listing.php\"> Now </a> ";
	echo '</div>';
	echo '<div id="right">';
	echo "<a href = \"listing.php?t=$next_hour&m=$next_ampm&d=$next_day&mo=$next_month&y=$next_year&tz=$timezone\"> Next </a>";
	echo '</div></div></div>';

	echo '<div id="bar"><div id="left">';
	echo "Date:".$date->format('Y-m-d');
	echo " || Time:".$date->format('h:i:a');
	echo " || Timezone: ".$timezone;
	
	//Drop-down menu to change timezone
	echo "<form method = \"POST\" action = \"listing.php\">
		  Change Timezone <select name = \"timezone\">
		  <option value=PST>PST</option>
		  <option value=MST>MST</option>
		  <option value=CST>CST</option>
		  <option value=EST>EST</option>
		  </select>
		  <input type = \"submit\" value = \"Submit\" name =\"submit\"></form>
		  ";
	
	echo '</div></div>';
	
	
	//End table
	echo"</table>";
	
	
	//}
	
	include_once("include/footer.php");
?>
