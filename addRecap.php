<?php
    include_once("include/header.php");

    function get_show_name( $id )
    {
    	$show_info = Db::get_show_info( $id );
    	return $show_info['name'];
    }

    function print_tv_show_menu()
    {
    	$ids = Db::get_all_tv_show_ids();
    	print "<select name=\"show_name\" id=\"default_select\">\n";
    	foreach( $ids as $id )
    	{
    		$name = get_show_name( $id );
    		print "<option value=\"$name\">$name</option>";
    	}
    	print "</select>";
    }

    function print_form()
    {
    	print
    	'<form name="recap_form" action="acknowledgeRecap.php" method="post" style="width: 500px">'.
		'	ADD RECAP'.
		'	<label>Name of TV show:</label>';
		print_tv_show_menu();
		print
		'<textarea name="recap">'.
		'Tell us what happened!'.
		'</textarea>'.
		'<br/>'.
		'<input type="submit" value="Submit" id="button">'.
		'</form>';
    }

    if( Access::user_has_access_level(Access::SUPER_USER) )
    	print_form();
?>


<?php
    include_once("include/footer.php");
?>
