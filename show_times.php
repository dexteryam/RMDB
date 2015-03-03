<?php
	$HEAD = '<link rel="stylesheet" type="text/css" href="css/show_times.css"/>';
	include_once("include/header.php");

	define( "THEATER_SEARCH_RADIUS", 15 );

	function create_url_query( $theater_id, $movie_id, $date)
	{
		$tid = isset($_GET['theater_id'])?$_GET['theater_id']:"";
		$mid = isset($_GET['movie_id'])?$_GET['movie_id']:"";
		$d = isset($_GET['date'])?$_GET['date']:"";

		if( $theater_id != "SAME" )
			$tid = $theater_id;
		if( $movie_id != "SAME" )
			$mid = $movie_id;
		if( $date != "SAME" )
			$d = $date;

		return "theater_id=".$tid."&"."movie_id=".$mid."&"."date=".$d;	
	}

	function wants_to_change_zip()
	{
		return isset( $_SESSION['show_times']['change_zip'] );
	}

	function have_zip()
	{
		return isset( $_SESSION['show_times']['zip'] );
	}

	function get_zip()
	{
		return $_SESSION['show_times']['zip'];
	}

	function get_movie_id()
	{
		return $_GET['movie_id'];
	}

	function have_movie_id()
	{
		if( !isset($_GET['movie_id']) )
			return false;
		return Db::is_movie( get_movie_id() );
	}

	function get_theater_id()
	{
		return $_GET['theater_id'];
	}

	function have_theater_id()
	{
		if( !isset($_GET['theater_id']) )
			return false;
		return Db::is_theater( get_theater_id() );
	}

	function was_zip_submitted()
	{
		return isset( $_POST['zip'] );
	}

	function process_zip()
	{
		if( isset( $_GET['change_zip'] ) )
		{
			$_SESSION['show_times']['change_zip'] = 1;
			$referer = $_SERVER['HTTP_REFERER'];
			header("Location: $referer");
			exit();
		}

		if( !was_zip_submitted() )
			return;

		$zip = $_POST['zip'];
		if( !preg_match( "/^\d{5}$/", $zip ) )
			return;

		unset($_SESSION['show_times']['change_zip']);
		$_SESSION['show_times']['zip'] = $zip;

		$referer = $_SERVER['HTTP_REFERER'];
		header("Location: $referer");
	}

	//$max_distance is in miles.
	function get_theater_ids( $zip_code, $max_distance = 20 )
	{
		$loc = get_lat_lng( $zip_code );
		$lat = $loc['lat'];
		$lng = $loc['lng'];
		
		$query = "SELECT id, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM theaters HAVING distance < '$max_distance' ORDER BY distance";

		$theaters = Db::query_rows( $query );

		$ids = array();
		foreach( $theaters as $theater )
			$ids[] = $theater['id'];

		return $ids;
	}

	function get_show_ids( $theater_id, $day )
	{
		$query = "SELECT DISTINCT show_id ".
			 	 "FROM show_times ".
			 	 "WHERE theater_id='$theater_id'";
		
		$show_ids_dirty = Db::query_rows( $query );
		$show_ids = array();

		foreach( $show_ids_dirty as $id )
			$show_ids[] = $id['show_id'];

		return $show_ids; 
	}

	function is_theater_id( $theater_id )
	{
		$theater_id = mysql_real_escape_string($theater_id);

		$query =
				"SELECT id ".
				"FROM theaters ".
				"WHERE id='$theater_id'";

		return Db::results_exist( $query );
	}


	function print_theater_info( $theater_id )
	{
		$theater = Db::get_theater_info( $theater_id );
		$name = $theater['name'];
		$address = $theater['address'];
		$city = $theater['city'];
		$state = $theater['state'];
		$zip = $theater['zipcode'];

		$url_query = create_url_query( $theater_id, "SAME", "SAME" );
		print
		"<div id=\"full_width_title_bar\">".
		"	<h1><a href=\"?$url_query\">$name</a></h1>".
		"	<h2>$address, $city $state $zip</h2>".
		"</div>";
	}

	function print_show_times( $theater_id, $movie_id, $date )
	{
		$times = get_show_times( $theater_id, $movie_id, $date );
		$movie = Db::get_show_info( $movie_id );
		$movie_name = $movie['name'];
		$url_query = create_url_query( "SAME", $movie_id, "SAME");

		print
		"<div id=\"full_width_content_bar\">".
		"	<h1><a href=\"?$url_query\">$movie_name</a></h1>".
		"	<div id=\"divider\"></div>".
		"	<span>";
		if( count( $times ) <= 0 )
			print "No Showtimes Found";
		for( $i = 0; $i < count($times); ++$i )
		{
			print strftime("%I:%M %p", strtotime($times[$i]) );
			if( $i < count($times) - 1 )
				print ' | ';
		}

		print
		"	</span>".
		"</div>";
	}

	function print_theaters_known_movie( $zip, $movie_id, $date )
	{
		$theater_ids = get_theater_ids( $zip, THEATER_SEARCH_RADIUS );
		if( count($theater_ids) == 0 )
			print
			"<div id=\"full_width_content_bar\">".
			"No theaters found within ".THEATER_SEARCH_RADIUS." miles of your area.";
			"</div>";
		foreach( $theater_ids as $theater_id )
		{
			print_theater_info( $theater_id );
			print_show_times( $theater_id, $movie_id, $date );
		}
	}

	function print_theaters_known_theater( $theater_id, $date )
	{
		if( !is_theater_id( $theater_id ) )
			return;

		$show_ids = get_show_ids( $theater_id, $date );
		if( count( $show_ids ) <= 0 )
			continue;

		print_theater_info( $theater_id );
		$shows_found = 0;
		foreach( $show_ids as $show_id )
		{
			$show = Db::get_show_info( $show_id );
			$show_name = $show['name'];
			$times = get_show_times( $theater_id, $show_id, $date );
			if( count($times) <= 0 )
				continue;
			$shows_found++;
			$url_query = create_url_query( "SAME", $show_id, "SAME");
			print
			"<div id=\"full_width_content_bar\">".
			"	<h1><a href=\"?$url_query\">$show_name</a></h1>".
			"	<div id=\"divider\"></div>".
			"		<span>";
			for( $i = 0; $i < count($times); ++$i )
			{
				print strftime("%I:%M %p", strtotime($times[$i]) );
				if( $i < count($times) - 1 )
					print ' | ';
			}
			print
			"		</span>".
			"</div>";
		}
		if( $shows_found == 0 )
		{
			print
			"<div id=\"full_width_content_bar\">".
			"No shows found for this date and theater.".
			"</div>";
		}
	}

	function printer_theaters( $zip, $date )
	{
		$theater_ids = get_theater_ids( $zip, THEATER_SEARCH_RADIUS );
		if( count($theater_ids) == 0 )
			print
			"<div id=\"full_width_content_bar\">".
			"No theaters found within ".THEATER_SEARCH_RADIUS." miles of your area.";
			"</div>";
		foreach( $theater_ids as $theater_id )
		{
			print_theaters_known_theater( $theater_id, $date );
		}
	}

	function print_date_icon( $date, $selected_date )
	{
		$today = date('Y-m-d', time() );
		$day_number = date('j', $date );
		$day_text = date('D', $date );
		$date = date('Y-m-d', $date );

		if( $date == $today )
			$day_text = "Today";

		if( $date != $selected_date )
		{
			$url_query = create_url_query( "SAME", "SAME", $date );
			print "<a href=\"?$url_query\">$day_text<br/>$day_number</a> ";
		}
		else
			print "<li>$day_text<br/>$day_number</li> ";
	}

	function print_date_selector( $num_of_date_icons = 5 )
	{
		$day = 60*60*24;
		$today = time();
		$offset1 = $today + $day;
		$offset2 = $offset1 + $day;
		$offset3 = $offset2 + $day;
		$offset4 = $offset3 + $day;

		$selected_day = get_selected_date();
		print "<div id=\"dates\"> ";
		for( $i = 0; $i < $num_of_date_icons; $i++ )
			print_date_icon( $today + ($day * $i), $selected_day );
		print "</div>";
	}

	function get_selected_date( $num_of_date_icons = 5 )
	{
		$day = 60*60*24;
		$max_date = time() + $day * ( $num_of_date_icons - 1 );
		$min_date = time();
		$date = isset($_GET['date']) ? $_GET['date'] : date( 'Y-m-d', time() );

		if( !strtotime( $date ) )
			$date = date( 'Y-m-d', time() );

		if( strtotime( $date ) > $max_date )
			$date = date( 'Y-m-d', $max_date );

		if( strtotime( $date ) < $min_date )
			$date = date( 'Y-m-d', $min_date );

		return $date;
	}

	function print_location_selector()
	{
		if( !have_zip() || wants_to_change_zip() )
		{
			$value = "";
			if( have_zip() )
				$value = get_zip();
	
			print
			'<div id="zip_form">'.
			"<form method=\"post\" action=\"\" >".
			"Enter Zipcode: ".
			"<input name=\"zip\" type=\"text\"/ size=\"5\" maxlength=\"5\" value=\"$value\" id=\"zip_bar\">".
			" <input type=\"submit\" id=\"button\"/>".
			"</form>"."</div>";
		}
		else
		{
			$page = $_SERVER['PHP_SELF'];
			$query = create_url_query( "SAME", "SAME", "SAME" );
			$url = $page."?".$query."&change_zip=1";
			print
			"<div id=\"right\">".
			"Theaters around <a href=\"$url\">".get_zip()."</a>. ".
			"</div>";
		}	
	}

	process_zip();

?>
	<div id="header_bar">
		<?php print_date_selector(); ?>
		<?php print_location_selector(); ?>
	</div>
	<div>
<?php
	
	if( !have_zip() )
	{
		print 
			"<div id=\"full_width_content_bar\">".
			"Enter your zipcode so we can find theaters near you.".
			"</div>";
	}
	else
	{
		$date = get_selected_date();
		if( have_movie_id() )
		{
			$zip = get_zip();
			$movie_id = get_movie_id();
			print_theaters_known_movie( $zip, $movie_id, $date );
		}
		else if( have_theater_id() )
		{
			$theater_id = get_theater_id();
			print_theaters_known_theater( $theater_id, $date );
		}
		else
		{
			$zip = get_zip();
			printer_theaters( $zip, $date );
		}
	}


?>
	</div>
<?php
	include_once("include/footer.php");
?>