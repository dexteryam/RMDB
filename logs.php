<?php
	include_once("include/header.php");

	define("OFFSET_STEP","20");

	function get_number_of_log_entries()
	{
		$query = 
		"SELECT COUNT(*) ".
		"FROM log";

		return Db::query_value( $query );
	}

	function get_offset()
	{
		$offset = isset($_GET['offset'])?$_GET['offset']:0;
		if( !is_numeric($offset) )
			return 0;
		if( $offset < 0 )
			return 0;
		return $offset;
	}

	function get_left()
	{
		$offset = get_offset();
		$new_offset = $offset - OFFSET_STEP;
		if( $offset > 0 )
			return '<a href="logs.php?offset='.$new_offset.'">&lt;&lt;</a>';
		return '&lt;&lt;';
	}

	function get_right()
	{
		$offset = get_offset();
		$new_offset = $offset + OFFSET_STEP;
		$num_entries = get_number_of_log_entries();

		if( $num_entries <= $new_offset )
			return '&gt;&gt;';
		return '<a href="logs.php?offset='.$new_offset.'">&gt;&gt;</a>';
	}

	function get_entries()
	{
		$offset = get_offset();

		$query = 
		"SELECT * ".
		"FROM log ".
		"ORDER BY creation_time DESC ".
		"LIMIT $offset,".OFFSET_STEP;

		$entries = Db::query_rows( $query );
		$rows = "";
		foreach( $entries as $entry )
		{
			$time = $entry['creation_time'];
			$page = $entry['page'];
			$message = $entry['message'];

			$rows .=
			'<div id="full_width_content_bar">'.
			"[$time][$page]: $message".
			'</div>';
		}
		
		return $rows;
	}

	function print_log()
	{
		$left = get_left();
		$right = get_right();
		$entries = get_entries();
		print
		'<div id="full_width_title_bar">'.
		'	<h1>Log</h1>'.
		'</div>'.
		'<div id="header_bar">'.
		'	<div id="left">'.
		$left.
		'	</div>'.
		'	<div id="right">'.
		$right.
		'	</div>'.
		'</div>'.
		$entries;

	}

	if( Access::user_has_access_level(Access::ADMINISTRATOR) )
		print_log();
	
?>



<?php
	include_once("include/footer.php");
?>
