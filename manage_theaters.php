<?php
	$HEAD = '<link rel="stylesheet" type="text/css" href="css/show_times.css"/>';
	include_once("include/header.php");

	function get_owned_theaters()
	{
		if( !Authenticate::is_user() )
			return array();

		$owner_id = Authenticate::get_id();
		$query = 
				"SELECT id ".
				"FROM theaters ".
				"WHERE owner_id='$owner_id'";
		$results = Db::query_rows( $query );
		$theater_ids = array();
		foreach( $results as $result )
			$theater_ids[] = $result['id'];
		return $theater_ids;
	}

	function is_theater_owner( $theater_id, $owner_id )
	{
		$theater_id = mysql_real_escape_string($theater_id);

		$query = 
				"SELECT id ".
				"FROM theaters ".
				"WHERE id='$theater_id' AND owner_id='$owner_id'";

		return Db::results_exist( $query );
	}

	function print_theaters()
	{
		print 
			"<h1>Your Theaters:</h1>";
		$theater_ids = get_owned_theaters();
		foreach( $theater_ids as $id )
		{
			$info = Db::get_theater_info( $id );
			$name = $info['name'];
			$address = $info['address'];
			$city = $info['city'];
			$state = $info['state'];
			$zip = $info['zipcode'];
			$phone_number = $info['phone_number'];

			print 
				'<div id="full_width_title_bar">'.
				"<h1><a href=\"manage_theaters.php?edit=$id\">".$name."</a></h1>".
				"<h2>".$address.", ".$city." ".$state." ". $zip ." | ". $phone_number . "</h2>".
				'</div>';
		}
		
	}

	function get_dates_from_theater_id( $id )
	{
		$id = mysql_real_escape_string($id);
		$query =
			"SELECT DISTINCT day ".
			"FROM show_times ".
			"WHERE theater_id='$id'";
		
		$results = Db::query_rows( $query );
		$dates = array();

		foreach( $results as $result )
			$dates[] = $result['day'];
		
		return $dates;
	}

	function get_shows_from_theater_id_and_date( $theater_id, $date )
	{
		$theater_id = mysql_real_escape_string($theater_id);
		$date = mysql_real_escape_string($date);

		$query =
			"SELECT DISTINCT show_id ".
			"FROM show_times ".
			"WHERE theater_id='$theater_id' AND day='$date'";

		$results = Db::query_rows( $query );
		$shows = array();

		foreach( $results as $result )
			$shows[] = $result['show_id'];

		return $shows;
	}

	function get_theater_id()
	{
		return isset($_GET['edit'])?$_GET['edit']:-1;
	}

	function get_date()
	{
		return isset($_GET['date'])?$_GET['date']:-1;
	}

	function print_date_bar()
	{
		$day = 60*60*24;
		$num_of_dates = 14;
		$today = time();

		$theater_id = get_theater_id();
		$dates = get_dates_from_theater_id( $theater_id );

		print '<div id="full_width_content_bar">';
		foreach( $dates as $date )
		{
			$time = strtotime( $date );
			$link_date = $date;
			$display_date = date( "m/d/Y", $time );

			$theater_id = get_theater_id();

			$url_query =
						"edit=$theater_id".
						"&date=$link_date";

			$url_delete_query = 
						"edit=$theater_id".
						"&delete_date=1".
						"&date=$link_date";

			print 
				"<li><a href=\"?$url_query\">$display_date</a> ".
				"[<a href=\"?$url_delete_query\" id=\"erase\">X</a>]</li>";
		}
		print '</div>';
	}

	function print_add_show_time_form( $date = "", $movie_id = "", $time = "" )
	{
		if( $date == "" )
			$date = time();
		if( $time == "" )
			$time = time();

		$date = strtotime($date);
		$month = date("n",$date);
		$day = date("j",$date);
		
		$hours = strftime("%I",$time);
		$minutes = strftime("%M", $time);
		$am_pm = strftime("%p", $time);

		print
			"<form method=\"post\" style=\"width: 880px\">";

		print "Movie:";
		print_movies_menu( $movie_id );

		print " Date:";
		print_months_menu( $month );
		print_days_menu( $day );
		print_years_menu();

		print " Time:";
		print_hours_menu( $hours );
		print ":";
		print_minutes_menu( $minutes );
		print_am_pm_menu( $am_pm );
		print
			"<input type=\"submit\" id=\"button\" style=\"display:inline-block\"/>".
			"</form>";
	}

	function print_show_times()
	{
		$date = get_date();
		$theater_id = get_theater_id();
		$shows = get_shows_from_theater_id_and_date( $theater_id, $date );

		print
			"<div id=\"full_width_title_bar\">".
			"<h1>Movies For Date: ".$date."</h1>".
			"</div>";

		foreach( $shows as $show )
		{
			$movie = Db::get_show_info( $show );
			$movie_name = $movie['name'];
			print
			"<div id=\"full_width_content_bar\">".
			"	<h1>$movie_name</h1>".
			"	<div id=\"divider\"></div>".
			"	<span>";
			$times = get_show_times( $theater_id, $show, $date );
			$latest_time;
			for( $i = 0; $i < count($times); ++$i )
			{
				$time = $times[$i];
				$url_query = 
							"edit=$theater_id".
							"&delete=1".
							"&movie_id=$show".
							"&date=$date".
							"&time=$time";
				print strftime("%I:%M %p", strtotime($times[$i]) ).
					"[<a href=\"?$url_query\" id=\"erase\">X</a>]";
				if( $i < count($times) - 1 )
					print ' | ';
				$latest_time = $times[$i];
			}
			print
			"	</span>".
			"</div>";

			$latest_time = strtotime( $latest_time );
			$latest_plus_an_hour = $latest_time + 3600;
			print_add_show_time_form( $date, $show, $latest_plus_an_hour );
		}
	}

	function print_theater_edit_ui()
	{
		$theater_id = get_theater_id();
		$owner_id = Authenticate::get_id();
		if( !is_theater_owner( $theater_id, $owner_id ) )
		{
			print "You do not own the theater specified.";
			return;
		}

		$info = Db::get_theater_info( $theater_id );
		$name = $info['name'];
		$address = $info['address'];
		$city = $info['city'];
		$state = $info['state'];
		$zip = $info['zipcode'];
		$phone_number = $info['phone_number'];
		print 
			"<h1>".$name."</h1>".
			"<div id=\"full_width_title_bar\"><h1>Add show time:</h1></div>";

		print_add_show_time_form();
		print
			"<br/>".
			"<div id=\"full_width_title_bar\"><h1>Current Dates:</h1></div>";
		print_date_bar();
		print "<br/>";
		print_show_times();
	}

	function process_form_submission()
	{
		$movie_id = isset($_POST['movie'])?$_POST['movie']:"";
		$month = isset($_POST['month'])?$_POST['month']:"";
		$day = isset($_POST['day'])?$_POST['day']:"";
		$year = isset($_POST['year'])?$_POST['year']:"";
		$hours = isset($_POST['hours'])?$_POST['hours']:"";
		$minutes = isset($_POST['minutes'])?$_POST['minutes']:"";
		$am_pm = isset($_POST['am_pm'])?$_POST['am_pm']:"";

		if( $movie_id == "" || $month == "" || $day == "" || $year == "" )
			return;
		if( $hours == "" || $minutes == "" || $am_pm == "" )
			return;
		if( !Db::is_show( $movie_id ) )
			return;

		$date = mktime( 0, 0, 0, $month, $day, $year );
		if( $am_pm == "pm" )
			if( $hours != 12 )
				$hours += 12;
		if( $am_pm == "am" )
			if( $hours == 12 )
				$hours = 0;
		$time = mktime( $hours, $minutes, 0, $month, $day, $year );

		if( !$date || !$time )
			return;

		if( !Db::is_show( $movie_id ) )
			return;

		$theater_id = get_theater_id();
		if( !Db::is_theater($theater_id) )
			return;


		$day = date( 'Y-m-d', $date );
		$show_time = strftime("%H:%M:%S", $time );

		$query = 
			"INSERT INTO show_times(theater_id,show_id,day,time) ".
			"VALUES('$theater_id','$movie_id','$day','$show_time')";
		Db::insert( $query );

		$referer = $_SERVER['HTTP_REFERER'];
		header("Location: $referer");
		exit();
	}

	function process_deletions()
	{
		$should_delete = isset($_GET['delete']);
		if( !$should_delete )
			return;

		$theater_id = get_theater_id();
		if( !is_theater_owner( $theater_id, Authenticate::get_id() ) )
		{
			$referer = $_SERVER['HTTP_REFERER'];
			header("Location: $referer");
			exit();
		}

		$movie_id = isset( $_GET['movie_id'] )?$_GET['movie_id']:"";
		$date = isset( $_GET['date'] )?$_GET['date']:"";
		$time = isset( $_GET['time'] )?$_GET['time']:"";

		if( $movie_id == "" || $date == "" || $time == "" )
			return;

		$theater_id = mysql_real_escape_string($theater_id);
		$movie_id = mysql_real_escape_string($movie_id);
		$date = mysql_real_escape_string($date);
		$time = mysql_real_escape_string($time);

		$query =
			"DELETE ".
			"FROM show_times ".
			"WHERE theater_id='$theater_id' AND show_id='$movie_id' ".
			"AND day='$date' AND time='$time'";

		Db::delete( $query );
		$referer = $_SERVER['HTTP_REFERER'];
		header("Location: $referer");
		exit();
	}

	function process_date_deletions()
	{
		$should_delete = isset($_GET['delete_date']);
		if( !$should_delete )
			return;

		$theater_id = get_theater_id();
		if( !is_theater_owner( $theater_id, Authenticate::get_id() ) )
		{
			$referer = $_SERVER['HTTP_REFERER'];
			header("Location: $referer");
			exit();
		}

		$date = isset( $_GET['date'] )?$_GET['date']:"";
		if( $date == "" )
			return;

		$theater_id = mysql_real_escape_string($theater_id);
		$date = mysql_real_escape_string($date);

		$query =
			"DELETE ".
			"FROM show_times ".
			"WHERE theater_id='$theater_id' AND day='$date'";

		Db::delete( $query );
		//$referer = $_SERVER['HTTP_REFERER'];
		//header("Location: $referer");
		//exit();
	}

	process_date_deletions();
	process_deletions();
	process_form_submission();
	if( isset($_GET['edit']) )
		print_theater_edit_ui();
	else
		print_theaters();
?>



<?php
	include_once("include/footer.php");
?>