<?php
    include_once("include/header.php");

    function print_add_menu() {
        $sids = Db::get_all_show_ids();

        print "<select name=\"add_name\" class=\"wl_dropdown\">";
        print "<option value=\"-1\">Not Selected</option>";
        $show_options = array();
        foreach( $sids as $sid ) {
            $sinfo = Db::get_show_info($sid);
            $show_name = $sinfo['name'];
            $show_options[] = "<option value=\"$show_name\">$show_name</option>";
        }
        sort($show_options);
        foreach($show_options as $show_option) {
            echo $show_option;
        }
        print "</select>";
    }

    /*  Instead of all shows, this should display only movies in the current users watchlist. */
    function print_remove_menu() {
        $user_id = Authenticate::get_id();
        $wl_query = "SELECT show_id FROM watchlists WHERE user_id=".$user_id;
        $wlq_results = Db::query_rows($wl_query);
        print "<select name=\"remove_name\" class=\"wl_dropdown\">";
        print "<option value=\"-1\">Not Selected</option>";
        $show_options = array();
        foreach($wlq_results as $wlq_result) {
            $show_id = $wlq_result['show_id'];
            $show_info = Db::get_show_info($show_id);
            $show_name = $show_info['name'];
            $show_options[] = "<option value=\"$show_name\">$show_name</option>";
            //print "<option value=\"$show_name\">$show_name</option>";
        }
        sort($show_options);
        foreach($show_options as $show_option) {
            echo $show_option;
        }
        print "</select>";
    }

    function print_add_form() {
        print 
            "<form name=\"add_form\" style=\"width:400px\" method=\"post\" action=\"\"".
            "<label>Add To Watchlist:</label>";
        print_add_menu();
        print
            "<br/><input type=\"submit\" id=\"button\" value=\"Add\">".
            "</form>";
    }

    function print_remove_form() {
        print 
            "<form name=\"remove_form\" style=\"width:400px\" method=\"post\" action=\"\"".
            "<label>Remove From Watchlist:</label>";
        print_remove_menu();
        print
            "<br/><input type=\"submit\" id=\"button\" value=\"Remove\">".
            "</form>";
    }

    function print_watchlist()
    {
        /*  Get a list of show_ids associated with this user id in the watchlist. */
        $uid = Authenticate::get_id();
        $query = "SELECT show_id FROM watchlists WHERE user_id=".$uid;
        $watchlist_rows = Db::query_rows($query);
        print 
        '<div id="full_width_title_bar">'.
        '<h1>Your Watchlist:</h1>'.
        '</div>';
        print '<div id="full_width_content_bar">';
        $links = array();
        foreach($watchlist_rows as $watchlist_row) {
            $show_info = Db::get_show_info($watchlist_row['show_id']);
            $name = $show_info['name'];
            $id = $show_info['id'];

            $link = "<li><a href=\"showPage.php?id=$id\">$name</a></li>";
            $links[$link] = $name;
        }

        asort($links);
        
        $print_links = array_keys($links);

        foreach($print_links as $print_link) {
            echo $print_link;
        }

        print '</div>';
    }

    function add_to_watchlist($user_id, $show_name) {
        $show_query = "SELECT id FROM shows WHERE name=\"".$show_name."\"";
        $results = Db::query_rows($show_query);
        $id = $results[0]['id'];

        /*  If this show is already in this user's watchlist, do not add it again. */
        $wl_query = "SELECT * FROM watchlists WHERE user_id=".$user_id;
        $wl_results = Db::query_rows($wl_query);
        foreach($wl_results as $wl_result) {
            if ($wl_result['show_id'] == $id) return;
        }

        $add_query = "INSERT INTO watchlists (user_id, show_id) VALUES (".$user_id.",".$id.")";
        Db::insert($add_query);
    }

    function remove_from_watchlist($user_id, $show_name) {
        $show_query = "SELECT id FROM shows WHERE name=\"".$show_name."\"";
        $results = Db::query_rows($show_query);
        $id = $results[0]['id'];
        $wl_query = "DELETE FROM watchlists WHERE user_id=".$user_id." AND show_id=\"".$id."\"";
        Db::delete($wl_query);
    }

    function process_forms() {
        if ( count($_POST) == 0)
            return;
        else if(isset($_POST['add_name'])) {
            add_to_watchlist(Authenticate::get_id(), $_POST['add_name']);
        }
        else if (isset($_POST['remove_name'])) {
            remove_from_watchlist(Authenticate::get_id(), $_POST['remove_name']);
        }
        else {
            echo "Fell through";
        }
    }

	$uid = Authenticate::get_id();
	if ( $uid == "" ) {
		echo "You are not logged in.<br />";
	}
    else {
        echo "<div><h1>Watchlist</h1></div>";
        process_forms();
        print_add_form();
        print_remove_form();
        print_watchlist();
    }
?>

<?php
    include_once("include/footer.php");
?>
