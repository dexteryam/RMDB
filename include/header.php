<?php
	
	$ROOT = $_SERVER['DOCUMENT_ROOT'].'/';

	include("include/tools.php");
	include("include/authenticate.php");
	include("include/access.php");
	Authenticate::authenticate_user();
	Authenticate::redirect_successful_login();

	function print_signup_login()
	{
		print '<div id="login_signup">';
		if( Authenticate::is_user() )
		{
			$id = Authenticate::get_id();
			$alias = Authenticate::get_alias();
			print
				'<b><a href="account.php">'.$alias.'</a></b> | '.
				'<a href="logout.php">Logout</a>';
		}
		else
		{
			print
				'<a href="login.php">Login</a> | '. 
				'<a href="signup.php">Signup</a>';
		}
		print
			'</div>';
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
<?php
	$URI = $_SERVER['REQUEST_URI'];
	$is_forum = strpos( $URI, "punbb" );

	if( $is_forum )
		print
		'<link rel="stylesheet" type="text/css" href="punbb/style/Oxygen/Oxygen.min.css"/>';
?>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
		
		<?php 
			if( isset($HEAD) )
				print $HEAD;
		?>
	</head>
	<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo"><a href="index.php"></a></div>
			<div id="links">
				<a href="movie_list.php?order=ASC">Movies</a>
				<a href="upcoming.php">New Movies</a>
				<a href="popular.php">Pop Movies</a>
				<a href="popularCeleb.php">Celebs</a>
				<a href="popularTV.php">Pop Shows</a>
				<a href="show_times.php">Showtimes</a>
				<a href="tv_list.php?order=ASC">TV Shows</a>
				<a href="listing.php">Guide</a>
				<a href="tvrecaps.php">Tv Recaps</a>
			</div>
			<?php print_signup_login() ?>
		</div>
<?php
	if( $is_forum )
		print '<div id="content_forum">';
	else
		print '<div id="content">';
	
	$uid = Authenticate::get_id();
	if ( $uid != "" ) {
		$url = $_SERVER['REQUEST_URI'];
		$date = getdate();
		$access_date = $date['year']."-".$date['mon']."-".$date['mday'];
		
		$query = "INSERT INTO browse_history (`user_id`, `url`, `date`) VALUES ('$uid', '$url', '$access_date');";
		$result = mysql_query($query);
	}
?>
