<?php
	include_once( "include/authenticate.php" );
	Authenticate::authenticate_user();
	if( Authenticate::is_user() )
	{
		$id = Authenticate::get_id();
		$message = "User ($id) logged out.";
		add_to_log($message);
	}

	Authenticate::kill_session();
	
	$location = $_SERVER['SERVER_NAME'];
	if( isset( $_SERVER['HTTP_REFERER'] ) )
		$location = $_SERVER['HTTP_REFERER'];
		
	header("Location: $location");
?>