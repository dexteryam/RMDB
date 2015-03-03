<?php
	include_once("include/header.php");


	function print_user_config()
	{
		print 
			'<div id="full_width_title_bar">'.
			'	<h1>User Configuration</h1>'.
			'</div>'.
			'<div id="full_width_content_bar">'.
			'<li><a href="userProfile.php">My Profile</a></li>'.
			'<li><a href="watchlist.php">My Watchlist</a></li>'.
			'</div><br/>';
	}

	function print_super_user_config()
	{
		print 
			'<div id="full_width_title_bar">'.
			'	<h1>Super-User Configuration</h1>'.
			'</div>'.
			'<div id="full_width_content_bar">'.
			'<li><a href="add_theater.php">Add Theater</a></li>'.
			'<li><a href="addShow.php">Add Show</a></li>'.
			'<li><a href="add_to_show.php">Add Content to Show</a></li>'.
			'<li><a href="addlisting.php">Add Tv Listing</a></li>'.
			'<li><a href="addRecap.php">Add Tv Recap</a></li>'.
			'<li><a href="upload_image.php">Upload Image</a></li>'.
			'</div><br/>';
	}

	function print_theater_owner_config()
	{
		print 
			'<div id="full_width_title_bar">'.
			'	<h1>Theater Owner Configuration</h1>'.
			'</div>'.
			'<div id="full_width_content_bar">'.
			'<a href="manage_theaters.php">Manage Theaters</a>'.
			'</div><br/>';
	}

	function print_administrator_config()
	{
		print 
			'<div id="full_width_title_bar">'.
			'	<h1>Administrator Configuration</h1>'.
			'</div>'.
			'<div id="full_width_content_bar">'.
			'<li><a href="set_theater_owner.php">Set Theater Owner</a></li>'.
			'<li><a href="set_access_level.php">Set User Access Level</a></li>'.
			'<li><a href="logs.php">Look At Logs</a></li>'.
			'</div>';
	}

	function print_config()
	{
		if( !Authenticate::is_user() )
			return;
		if( Access::user_has_access_level( Access::USER ) )
			print_user_config();
		if( Access::user_has_access_level( Access::SUPER_USER ) )
			print_super_user_config();
		if( Access::is_theater_owner() )
			print_theater_owner_config();
		if( Access::user_has_access_level( Access::ADMINISTRATOR ) )
			print_administrator_config();
	}
	
	print_config();

?>




<?php
	include_once("include/footer.php");
?>
