<?php

	
	function get_lat_lng( $address_or_zip )
	{
		$KEY = "ABQIAAAAiUHITYNE36gbSV8HnoAothSyoyqmUPJP_9FGx9KGcokYXRgeQxRz92YJ-O4sbQd75vjVILl06SBeTg";
		$base_url = "http://maps.google.com/maps/geo?output=csv&key=".$KEY;

		$request_url = $base_url . "&q=" . urlencode($address_or_zip);
		$csv = file_get_contents($request_url) or die("Unable to acquire location data from google.");

		$csv_split = preg_split("/,/", $csv);
		$result = array();
		$result['lat'] = $csv_split[2];
		$result['lng'] = $csv_split[3];

		return $result;
	}

	function get_show_times( $theater_id, $show_id, $date )
	{
		$theater_id = mysql_real_escape_string($theater_id);
		$show_id = mysql_real_escape_string($show_id);
		$date = mysql_real_escape_string($date);

		$query = "SELECT time ".
			 	 "FROM show_times ".
			 	 "WHERE theater_id='$theater_id' AND show_id='$show_id' AND day='$date'".
			 	 "ORDER BY time ASC";

		$times_dirty = Db::query_rows( $query );
		$times = array();

		foreach( $times_dirty as $time )
			$times[] = $time['time'];

		return $times;
	}

	function print_movies_menu( $selected_id = "" )
	{
		$query =
			"SELECT name, id ".
			"FROM shows ".
			"WHERE type='movie' ".
			"ORDER BY release_date DESC";

		$movies = Db::query_rows( $query );
		
		print "<select name=\"movie\">\n";
		foreach( $movies as $movie )
		{
			$id = $movie['id'];
			$name = $movie['name'];

			$selected = "";
			if( $selected_id == $id )
				$selected = " selected=\"selected\"";

			print 
				"	<option value=\"$id\"$selected>$name</option>\n";
		}
		print "</select>\n";
	}

	function print_years_menu()
	{
		print "<select name=\"year\">\n";
		$year = date("Y",time());
		$final_year = $year + 1;

		for( $i=$year; $i<=$final_year; $i++ )
			print
				"	<option value=\"$i\"$selected>$i</option>\n";
		print "</select>\n";
	}

	function print_months_menu( $selected_month = "" )
	{
		print "<select name=\"month\">\n";
		for( $i=1; $i <= 12; $i++ )
		{
			$month = date("F", mktime(0, 0, 0, $i+1, 0, 0) );
			$selected = "";
			if( $selected_month == $i )
				$selected = " selected=\"selected\"";
			print 
				"	<option value=\"$i\"$selected>$month</option>\n";
		}
		print "</select>\n";	
	}

	function print_days_menu( $selected_day = "" )
	{
		print "<select name=\"day\">\n";
		for( $i=1; $i <= 31; $i++ )
		{
			$selected = "";
			if( $selected_day == $i )
				$selected = " selected=\"selected\"";
			print 
				"	<option value=\"$i\"$selected>$i</option>\n";
		}
		print "</select>\n";	
	}

	function print_hours_menu( $selected_hour = "" )
	{
		print "<select name=\"hours\">\n";
		for( $i=1; $i <= 12; $i++ )
		{
			$selected = "";
			if( $selected_hour == $i )
				$selected = " selected=\"selected\"";
			print 
				"	<option value=\"$i\"$selected>$i</option>\n";
		}
		print "</select>\n";	
	}

	function print_minutes_menu( $selected_mins = "" )
	{
		print "<select name=\"minutes\">\n";
		for( $i=0; $i <= 55; $i+=5 )
		{
			$selected = "";
			if( $selected_mins == $i )
				$selected = " selected=\"selected\"";
			print 
				"	<option value=\"$i\"$selected>$i</option>\n";
		}
		print "</select>\n";	
	}

	function print_am_pm_menu( $selected_am_pm = "" )
	{
		$am_selected = "";
		$pm_selected = "";

		if( $selected_am_pm == "AM" )
			$am_selected = " selected=\"selected\"";
		else
			$pm_selected = " selected=\"selected\"";

		print 
			"<select name=\"am_pm\">\n".
			"	<option value=\"am\" $am_selected>AM</option>\n".
			"	<option value=\"pm\" $pm_selected>PM</option>\n".
			"</select>\n";
	}

	function get_current_page()
	{
		return $_SERVER["PHP_SELF"];
	}

	function add_to_log( $message )
	{
		$page = mysql_real_escape_string(get_current_page());
		$message = mysql_real_escape_string($message);


		$query = 
		"INSERT INTO log ".
		"(page,message) ".
		"VALUES ('$page','$message')";

		Db::insert( $query );
	}

?>