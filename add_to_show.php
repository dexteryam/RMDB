<?php
    include_once("include/header.php");
    
    //For sending mail to the users
    function send_mail( $to, $subject, $body )
    {
        $ROOT = "http://www.cody-jackson.com/";
        $PAGE = "send_mail.php";

        $to = urlencode($to);
        $subject = urlencode($subject);
        $body = urlencode($body);

        $url = $ROOT.$PAGE."?to=$to&subject=$subject&body=$body";

        $html = file_get_contents($url);
        return $html == "SENT";
    }

    function get_show_name( $id )
    {
    	$show_info = Db::get_show_info( $id );
    	return $show_info['name'];
    }

    function get_show_id()
    {
        return $_GET['show_id'];
    }

    function is_show_id_valid()
    {
        if( !isset($_GET['show_id']) )
            return;
        return Db::is_show( get_show_id() );
    }

    function print_cast_menu()
    {
        $aids = Db::get_all_cast_ids();

        print "<select name=\"existing_cast\" id=\"default_select\">\n";
        print "<option value=\"-1\">Not Selected</option>";
        foreach( $aids as $aid )
        {
            $a_info = Db::get_cast_info( $aid );
            $name = $a_info['name'];
            print 
                "   <option value=\"$name\">$name</option>\n";
        }
        print "</select>\n";    
    }

    function print_trailer_form()
    {
        print
        "<form name=\"trailer_form\" style=\"width:400px\" method=\"post\" action=\"\">\n".
        "<h1>Add Trailer</h1>\n".
        "<label>Youtube Embed Url:</label>\n".
        "<input type=\"text\" name=\"url\"/>\n".
        "<input type=\"submit\" id=\"button\" value=\"Add\"/>\n".
        "</form>\n";
    }

    function print_cast_form()
    {
        print
        "<form name=\"cast_form\" style=\"width:400px\" method=\"post\" action=\"\">\n".
        "<h1>Add Cast Member</h1>\n".
        "<label>Existing Cast Member:</label>\n";
        print_cast_menu();
        print
        "or<br/>".
        "<label>New Cast Member</label>".
        "<input type=\"text\" name=\"new_cast\"/>\n".
        "<input type=\"submit\" id=\"button\" value=\"Add\"/>\n".
        "</form>\n";
    }

    function print_quote_form()
    {
        print
        "<form name=\"trailer_form\" style=\"width:400px\" method=\"post\" action=\"\">\n".
        "<h1>Add Quote</h1>\n".
        "<label>Quote:</label>\n".
        "<textarea name=\"quote\" style=\"width: 392px; height: 100px\">Enter a quote.</textarea>\n".
        "<input type=\"submit\" id=\"button\" value=\"Add\"/>\n".
        "</form>\n";
    }

    function print_trailers()
    {
        print 
        '<div id="full_width_title_bar">'.
        '<h1>Trailers</h1>'.
        '</div>';

        $show_id = get_show_id();
        $query = 
        "SELECT url ".
        "FROM trailers ".
        "WHERE show_id='$show_id'";

        $urls = Db::query_rows( $query );
        if( count($urls) <= 0 )
            return;

        print '<div id="full_width_content_bar">';
        foreach( $urls as $url )
        {
            $url = $url['url'];
            print "<li>$url</li>";
        }
        print '</div>';
    }

    function add_trailer( $url )
    {
        $show_id = mysql_real_escape_string(get_show_id());
        $url = mysql_real_escape_string($url);

        $query = 
        "INSERT INTO trailers (show_id,url) ".
        "VALUES ('$show_id','$url')";

        Db::insert($query);

        $query = "SELECT user_id FROM watchlists WHERE show_id ='" . $show_id . "'";
        $id_rows = Db::query_rows($query);
        $ids = array();
        foreach ($id_rows as $id_row) {
            array_push($ids, $id_row['user_id']);
        }

        $emails = array();
        foreach ($ids as $id) {
            $query = "SELECT email FROM users WHERE id='".$id."'";
            $email = Db::query_value($query);
            array_push($emails, $email);
        }

        foreach ($emails as $email) {
            $x = Db::get_show_info($show_id);
            $show_name = $x[name];

            $to = $email;
            $subject = "New info for your favorite show!";
            $message = "A new trailer from " . $show_name . " has been added to RMDb.";
            send_mail($to, $subject, $message);
        }
    }

    function print_cast()
    {
        print 
        '<div id="full_width_title_bar">'.
        '<h1>Cast</h1>'.
        '</div>';

        $show_id = get_show_id();
        $query = 
        "SELECT name ".
        "FROM cast ".
        "WHERE show_id='$show_id'";

        $names = Db::query_rows( $query );
        if( count($names) <= 0 )
            return;

        print '<div id="full_width_content_bar">';
        foreach( $names as $name )
        {
            $name = $name['name'];
            print "<li>$name</li>";
        }
        print '</div>';
    }


    function add_cast( $name )
    {
        $show_id = mysql_real_escape_string(get_show_id());
        $name = mysql_real_escape_string($name);

        $query = 
        "INSERT INTO cast (name,show_id) ".
        "VALUES ('$name','$show_id')";

        Db::insert($query);

        $query = "SELECT user_id FROM watchlists WHERE show_id ='" . $show_id . "'";
        $id_rows = Db::query_rows($query);
        $ids = array();
        foreach ($id_rows as $id_row) {
            array_push($ids, $id_row['user_id']);
        }

        $emails = array();
        foreach ($ids as $id) {
            $query = "SELECT email FROM users WHERE id='".$id."'";
            $email = Db::query_value($query);
            array_push($emails, $email);
        }

        foreach ($emails as $email) {
            $x = Db::get_show_info($show_id);
            $show_name = $x[name];

            $to = $email;
            $subject = "New info for your favorite show!";
            $message = "A new cast member from " . $show_name . " has been added to RMDb.";
            send_mail($to, $subject, $message);
        }
    }

    function print_quotes()
    {
        print 
        '<div id="full_width_title_bar">'.
        '<h1>Quotes</h1>'.
        '</div>';

        $show_id = get_show_id();
        $query = 
        "SELECT quote ".
        "FROM quotes ".
        "WHERE show_id='$show_id'";

        $quotes = Db::query_rows( $query );
        if( count($quotes) <= 0 )
            return;

        foreach( $quotes as $quote )
        {
            $quote = $quote['quote'];
            print 
            '<div id="full_width_content_bar">'.
            "\"$quote\"".
            '</div>';
        }
    }

    function add_quote( $quote )
    {
        $show_id = mysql_real_escape_string(get_show_id());
        $quote = mysql_real_escape_string($quote);

        $query = 
        "INSERT INTO quotes (show_id,quote) ".
        "VALUES ('$show_id','$quote')";

        Db::insert($query);

        $query = "SELECT user_id FROM watchlists WHERE show_id ='" . $show_id . "'";
        $id_rows = Db::query_rows($query);
        $ids = array();
        foreach ($id_rows as $id_row) {
            array_push($ids, $id_row['user_id']);
        }

        $emails = array();
        foreach ($ids as $id) {
            $query = "SELECT email FROM users WHERE id='".$id."'";
            $email = Db::query_value($query);
            array_push($emails, $email);
        }

        foreach ($emails as $email) {
            $x = Db::get_show_info($show_id);
            $show_name = $x[name];

            $to = $email;
            $subject = "New info for your favorite show!";
            $message = "A new quote from " . $show_name . " has been added to RMDb.";
            send_mail($to, $subject, $message);
        }
    }

    function get_images()
    {
        $images = array();
        if ($handle = opendir('./img')) {
            while (false !== ($entry = readdir($handle))) {
                if (!is_dir($entry) && $entry != "." && $entry != ".." && !is_dir("./img/".$entry)) 
                {
                    $images[] = $entry;
                }
            }
            closedir($handle);
        }
        return $images;
    }

    function print_images_menu()
    {
        $images = get_images();

        print "<select name=\"image\" id=\"default_select\">\n";
        foreach( $images as $image )
        {
            print 
                "   <option value=\"$image\">$image</option>\n";
        }
        print "</select>\n";  
    }

    function print_photos()
    {
        print 
        '<div id="full_width_title_bar">'.
        '<h1>Photos</h1>'.
        '</div>';

        $show_id = get_show_id();
        $query = 
        "SELECT url ".
        "FROM photos ".
        "WHERE show_id='$show_id'";

        $urls = Db::query_rows( $query );
        if( count($urls) <= 0 )
            return;

        print '<div id="full_width_content_bar">';
        foreach( $urls as $url )
        {
            $url = $url['url'];
            print "<li>$url</li>";
        }
        print '</div>';
    }

    function print_photo_form()
    {
        print
        "<form name=\"photo\" style=\"width:400px\" method=\"post\" action=\"\">\n".
        "<h1>Add Photo</h1>\n".
        "<label>Image:</label>\n";
        print_images_menu();
        print
        "<input type=\"submit\" id=\"button\" value=\"Add\"/>\n".
        "</form>\n";
    }

    function add_photo( $url )
    {
        $show_id = mysql_real_escape_string(get_show_id());
        $url = mysql_real_escape_string($url);
        $prefix = "./img/";
        $query = 
        "INSERT INTO photos (show_id,url) ".
        "VALUES ('$show_id','$prefix$url')";

        Db::insert($query);

        $query = "SELECT user_id FROM watchlists WHERE show_id ='" . $show_id . "'";
        $id_rows = Db::query_rows($query);
        $ids = array();
        foreach ($id_rows as $id_row) {
            array_push($ids, $id_row['user_id']);
        }

        $emails = array();
        foreach ($ids as $id) {
            $query = "SELECT email FROM users WHERE id='".$id."'";
            $email = Db::query_value($query);
            array_push($emails, $email);
        }

        foreach ($emails as $email) {
            $x = Db::get_show_info($show_id);
            $show_name = $x[name];

            $to = $email;
            $subject = "New info for your favorite show!";
            $message = "A new photo from " . $show_name . " has been added to RMDb.";
            send_mail($to, $subject, $message);
        }
    }

    function process_forms()
    {

        if( count($_POST) == 0 )
            return;

        if( isset( $_POST['url']) )
            add_trailer( $_POST['url'] );
        else if( isset( $_POST['existing_cast'] ) )
        {
            if( $_POST['existing_cast'] != -1 )
                add_cast( $_POST['existing_cast'] );
            else
                add_cast( $_POST['new_cast'] );
        }
        else if( isset( $_POST['quote'] ) )
            add_quote( $_POST['quote'] );
        else if( isset( $_POST['image'] ) )
            add_photo( $_POST['image'] );

        header("Location: ".$_SERVER['HTTP_REFERER'] );
        exit();
    }

    function print_shows()
    {
        $show_ids = Db::get_all_show_ids();

        print 
        '<div id="full_width_title_bar">'.
        '<h1>Select a Show:</h1>'.
        '</div>';
        print '<div id="full_width_content_bar">';
        foreach( $show_ids as $id )
        {
            $show_info = Db::get_show_info( $id );
            $name = $show_info['name'];
            print "<li><a href=\"?show_id=$id\">$name</a></li>";
        }
        print '</div>';
    }

    if( Access::user_has_access_level( Access::SUPER_USER))
    {
        if( is_show_id_valid() )
        {
            process_forms();
            $show_id = get_show_id();
            $show_info = Db::get_show_info( $show_id );
            $name = $show_info['name'];
            print "<h1>$name</h1>";

            print_trailers();
            print_trailer_form();
            print '<br/>';
            print_cast();
            print_cast_form();
            print '<br/>';
            print_quotes();
            print_quote_form();
            print '<br/>';
            print_photos();
            print_photo_form();
        }
        else
            print_shows();

    }


?>


<?php
    include_once("include/footer.php");
?>
