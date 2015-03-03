<?php
    include_once("include/header.php");
?>

<?php
if( Access::user_has_access_level(Access::SUPER_USER) )
{
    /*  Get the name of the TV show. */
    $show_name = $_POST['show_name'];

    /*  Get the recap. */
    $recap = $_POST['recap'];

    /*  If this show already exists in the shows table, then go ahead and add this
        recap to the recaps table. */
    $query = "SELECT name FROM shows WHERE name = '" . $show_name . "'";
    $result = mysql_query($query);
    $result_array = mysql_fetch_array($result);
    if (empty($result_array)) {
        echo "Sorry, that show isn't currently tracked in our database. Ask one of our administrators to add it for you!";
    }
    else {
        /*  To add this to the recaps table we need the associated show_id, the
            user_id, and the recap itself. */
        $user_id = Authenticate::get_id();
        
        /*  Query the database for the show_id. */
        $sid_query = "SELECT id FROM shows WHERE name = '" . $show_name . "'";
        $sid_result = mysql_query($sid_query);
        $sid_array = mysql_fetch_array($sid_result);
        $show_id = $sid_array[0];

        /*  Insert this query into the recaps table. */
        $insert_query = "INSERT INTO recaps (show_id, user_id, content) VALUES (" . $show_id . ", " . $user_id . ", \"" . mysql_real_escape_string($recap) . "\")";
        mysql_query($insert_query);

        echo "Thanks for contributing a recap to RMDB!";
    }
}
?>

<?php
    include_once("include/footer.php");
?>
