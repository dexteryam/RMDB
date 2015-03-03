<?php
	include_once("include/header.php");
	if( Access::user_has_access_level( Access::SUPER_USER ) ){


		
		
		  if($_SERVER['REQUEST_METHOD'] == "POST"){
			$submit = $_POST['submit'];
			$ch_id = $_POST['ch_id'];
			$title = $_POST['title'];
			$query = "SELECT id FROM shows WHERE name ='$title'";
			
			$showcheck = mysql_query($query);
			$show = Db::query_row($query);
			$count = mysql_num_rows($showcheck);
			if(!$count){
				die( "Show does not exist! <a href =\"addlisting.php\"> Back </a>");
			}
			else{
				$show_id=$show['id'];
				echo $show_id['id'];
			}
			
			$time_hour=$_POST['time_hour'];
			$time_min=$_POST['time_min'];
			$time_ampm=$_POST['time_ampm'];
			$date_day =$_POST['day'];
			$date_month = $_POST['month'];
			$date_year = $_POST['year'];
			if($date_month == 1 || $date_month == 3 || $date_month == 5 || $date_month == 7|| 
				$date_month == 8|| $date_month == 10|| $date_month == 12){
				if($date_day > 31){
					die( "Error: Day not valid <a href =\"addlisting.php\"> Back </a>");
				}
			}
			else if($date_month == 4 || $date_month == 6 || $date_month == 9 || $date_month == 11 ){
				if($date_day > 30){
					die( "Error: Day not valid <a href =\"addlisting.php\"> Back </a>");
				}
			}
			else if($date_month == 2){
				if($date_year % 4){
					if($date_day > 28){
						die( "Error: Day not valid <a href =\"addlisting.php\"> Back </a>");
					}
				}
				if($date_day > 29){
					die( "Error: Day not valid <a href =\"addlisting.php\"> Back </a>");
				}
			}
			
			//if($_SERVER['REQUEST_METHOD'] == "POST"){
				if($submit){
					
					$query = "SELECT * FROM listing WHERE hour = '$time_hour' AND min = '$time_min' AND am_pm = '$time_ampm' AND 
						day = '$date_day' AND month = '$date_month' AND year = '$date_year' AND ch_id = '$ch_id'";
					$timecheck = mysql_query($query);
					$timecount = mysql_num_rows($timecheck);
					if($timecount){
						die( "Error: Time not available! <a href =\"addlisting.php\"> Back </a>");
					}
					
					$querylist = mysql_query("INSERT INTO listing VALUES (
								  '$ch_id','$show_id','$time_hour','$time_min','$time_ampm','$date_day','$date_month','$date_year')");
					
					die("Show has been added. <a href =\"listing.php\">Listing</a>
						<a href =\"addlisting.php\">Add Another Show</a>");
				}
			//}
		}	
//	}
	
	echo "
		<h3>Add a show to the listing </h3>
		<a href = \"listing.php\"> Back to Listing</a>
		<table>
		<form method = \"POST\" action = \"addlisting.php\">
		<tr><td>Show Title:</td> <td><input type = \"text\" name = \"title\"></td></tr>
		<tr><td>Time: </td> <td>
		<select name = \"time_hour\">
		  <option value=1>1</option>
		  <option value=2>2</option>
		  <option value=3>3</option>
		  <option value=4>4</option>
		  <option value=5>5</option>
		  <option value=6>6</option>
		  <option value=7>7</option>
		  <option value=8>8</option>
		  <option value=9>9</option>
		  <option value=10>10</option>
		  <option value=11>11</option>
		  <option value=12>12</option>
		</select>
		:
		<select name = \"time_min\">
		  <option value=\"00\">00</option>
		  <option value=\"30\">30</option>
		</select>
		<select name = \"time_ampm\">
		  <option value=\"am\">am</option>
		  <option value=\"pm\">pm</option>
		</select></td></tr>
		
		<tr><td>dd/mm/yyyy: <td><input type = \"text\" name = \"day\" size =\"1\"> <input type = \"text\" name = \"month\" size =\"1\">
		 <input type = \"text\" name = \"year\" size =\"1\"></td></tr>
		
		<tr><td>Channel: </td><td>
		<select name =\"ch_id\">";

		$result = mysql_query("SELECT * FROM channels");
		$num_rows = mysql_num_rows($result);
		$loop = 0;
		//Loops displays all channels in a select menu
		while($loop < $num_rows){
			$f1 = mysql_result($result,$loop,"ch_name");
			echo "<option value =".($loop+1).">".$f1."</option>";
			$loop++;
		}
		echo "</select></td></tr>
		<tr><td><input type = \"submit\" value = \"Submit\" name =\"submit\"></td></tr></table>
		";
	}
		include_once("include/footer.php");
?>